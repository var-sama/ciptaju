<?php

use App\Models\StudentRegistration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

uses(RefreshDatabase::class);

function studentRegistrationPayload(array $overrides = []): array
{
    return array_merge([
        'school_target' => 'SMP',
        'school_year' => '2026/2027',
        'student_name' => 'Nama Calon Murid',
        'gender' => 'female',
        'date_of_birth' => '2012-04-15',
        'parent_guardian_name' => 'Nama Wali',
        'parent_guardian_phone' => '+62 812-3456-7890',
        'home_address' => 'Jalan Sekolah Nomor 10',
    ], $overrides);
}

test('student registration schema stores application fields separately from users', function () {
    expect(Schema::getColumnListing('student_registrations'))->toBe([
        'id',
        'school_target',
        'school_year',
        'student_name',
        'gender',
        'date_of_birth',
        'parent_guardian_name',
        'parent_guardian_phone',
        'home_address',
        'status',
        'created_at',
        'updated_at',
    ])->and(Schema::hasColumn('users', 'student_name'))->toBeFalse();
});

test('student registration form contains application fields and no account credentials', function () {
    $this->get(route('auth.registration'))
        ->assertSuccessful()
        ->assertSee('name="_token"', false)
        ->assertSee('name="school_target"', false)
        ->assertSee('name="school_year"', false)
        ->assertSee('name="student_name"', false)
        ->assertSee('name="gender"', false)
        ->assertSee('name="date_of_birth"', false)
        ->assertSee('name="parent_guardian_name"', false)
        ->assertSee('name="parent_guardian_phone"', false)
        ->assertSee('name="home_address"', false)
        ->assertDontSee('name="email"', false)
        ->assertDontSee('name="password"', false)
        ->assertDontSee('Email Address');
});

test('public student registration is stored in its own table without creating a user', function () {
    $this->post(route('auth.registration.store'), studentRegistrationPayload())
        ->assertRedirect(route('auth.registration'))
        ->assertSessionHas('success', 'Pendaftaran berhasil dikirim.');

    $registration = StudentRegistration::query()->firstOrFail();

    $this->assertModelExists($registration);
    $this->assertDatabaseCount('users', 0);
    expect($registration->school_target)->toBe('SMP')
        ->and($registration->school_year)->toBe('2026/2027')
        ->and($registration->student_name)->toBe('Nama Calon Murid')
        ->and($registration->gender)->toBe('female')
        ->and($registration->date_of_birth->toDateString())->toBe('2012-04-15')
        ->and($registration->parent_guardian_name)->toBe('Nama Wali')
        ->and($registration->parent_guardian_phone)->toBe('+62 812-3456-7890')
        ->and($registration->home_address)->toBe('Jalan Sekolah Nomor 10')
        ->and($registration->status)->toBe(StudentRegistration::STATUS_PENDING);
});

test('student registration validates fields and keeps previous input without saving an invalid record', function () {
    $this->from(route('auth.registration'))
        ->post(route('auth.registration.store'), studentRegistrationPayload([
            'school_target' => 'TK',
            'school_year' => '2025/2026',
            'gender' => 'other',
            'date_of_birth' => now()->addDay()->toDateString(),
            'parent_guardian_phone' => str_repeat('1', 31),
            'home_address' => str_repeat('a', 2001),
        ]))
        ->assertRedirect(route('auth.registration'))
        ->assertSessionHasErrors([
            'school_target',
            'school_year',
            'gender',
            'date_of_birth',
            'parent_guardian_phone',
            'home_address',
        ])
        ->assertSessionHas('_old_input.student_name', 'Nama Calon Murid');

    expect(StudentRegistration::query()->count())->toBe(0);
});

test('only admins can access student registration records', function () {
    StudentRegistration::create(studentRegistrationPayload());

    $this->get(route('admin.registrations.index'))
        ->assertRedirect(route('auth.login'));

    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->get(route('admin.registrations.index'))
        ->assertForbidden();
});

test('admin can view applicant details and update registration status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $registration = StudentRegistration::create(studentRegistrationPayload());

    $this->actingAs($admin)
        ->get(route('admin.registrations.index'))
        ->assertSuccessful()
        ->assertSee('Nama Calon Murid')
        ->assertSee(route('admin.registrations.show', $registration), false);

    $this->get(route('admin.registrations.show', $registration))
        ->assertSuccessful()
        ->assertSee('Nama Wali')
        ->assertSee('Jalan Sekolah Nomor 10');

    $this->patch(route('admin.registrations.status', $registration), [
        'status' => StudentRegistration::STATUS_ACCEPTED,
    ])->assertRedirect(route('admin.registrations.show', $registration));

    expect($registration->refresh()->status)->toBe(StudentRegistration::STATUS_ACCEPTED)
        ->and(User::query()->count())->toBe(1);
});

test('admin cannot set an unsupported student registration status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $registration = StudentRegistration::create(studentRegistrationPayload());

    $this->actingAs($admin)
        ->patch(route('admin.registrations.status', $registration), ['status' => 'enrolled'])
        ->assertSessionHasErrors('status');

    expect($registration->refresh()->status)->toBe(StudentRegistration::STATUS_PENDING);
});
