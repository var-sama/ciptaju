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

test('guest is redirected from the student registration button to login and returned after login', function () {
    $student = User::factory()->create([
        'email' => 'student@example.com',
        'password' => 'password',
        'role' => 'student',
    ]);

    $this->get(route('students.index'))
        ->assertSuccessful()
        ->assertSee(route('auth.registration'), false);

    $this->get(route('auth.registration'))
        ->assertRedirect(route('auth.login'))
        ->assertSessionHas('url.intended', route('auth.registration'));

    $this->post(route('auth.login.submit'), [
        'email' => $student->email,
        'password' => 'password',
    ])->assertRedirect(route('auth.registration'));

    $this->assertAuthenticatedAs($student);

    $this->get(route('auth.registration'))
        ->assertSuccessful();
});

test('student registration form contains application fields and no account credentials', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->get(route('students.index'))
        ->assertSuccessful()
        ->assertSee(route('auth.registration'), false);

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

test('authenticated student registration is stored in its own table without creating another user', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->post(route('auth.registration.store'), studentRegistrationPayload())
        ->assertRedirect(route('auth.registration'))
        ->assertSessionHas('success', 'Pendaftaran berhasil dikirim.');

    $registration = StudentRegistration::query()->firstOrFail();

    $this->assertModelExists($registration);
    $this->assertDatabaseCount('users', 1);
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

test('guest cannot submit the student registration form', function () {
    $this->post(route('auth.registration.store'), studentRegistrationPayload())
        ->assertRedirect(route('auth.login'));

    expect(StudentRegistration::query()->count())->toBe(0);
});

test('student registration validates fields and keeps previous input without saving an invalid record', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->from(route('auth.registration'))
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

    $this->get(route('admins.registrations.index'))
        ->assertRedirect(route('auth.login'));

    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->get(route('admins.registrations.index'))
        ->assertForbidden();
});

test('admin can view applicant details and update registration status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $registration = StudentRegistration::create(studentRegistrationPayload());

    $this->actingAs($admin)
        ->get(route('admins.registrations.index'))
        ->assertSuccessful()
        ->assertSee('Nama Calon Murid')
        ->assertSee(route('admins.registrations.show', $registration), false);

    $this->get(route('admins.registrations.show', $registration))
        ->assertSuccessful()
        ->assertSee('Nama Wali')
        ->assertSee('Jalan Sekolah Nomor 10');

    $this->patch(route('admins.registrations.status', $registration), [
        'status' => StudentRegistration::STATUS_ACCEPTED,
    ])->assertRedirect(route('admins.registrations.show', $registration));

    expect($registration->refresh()->status)->toBe(StudentRegistration::STATUS_ACCEPTED)
        ->and(User::query()->count())->toBe(1);
});

test('admin cannot set an unsupported student registration status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $registration = StudentRegistration::create(studentRegistrationPayload());

    $this->actingAs($admin)
        ->patch(route('admins.registrations.status', $registration), ['status' => 'enrolled'])
        ->assertSessionHasErrors('status');

    expect($registration->refresh()->status)->toBe(StudentRegistration::STATUS_PENDING);
});

test('registration dashboard shows database totals independently from search and status filters', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    StudentRegistration::create(studentRegistrationPayload([
        'student_name' => 'Siti Pending',
        'status' => StudentRegistration::STATUS_PENDING,
    ]));
    StudentRegistration::create(studentRegistrationPayload([
        'student_name' => 'Siti Accepted',
        'status' => StudentRegistration::STATUS_ACCEPTED,
    ]));
    StudentRegistration::create(studentRegistrationPayload([
        'student_name' => 'Budi Rejected',
        'status' => StudentRegistration::STATUS_REJECTED,
    ]));

    $response = $this->actingAs($admin)->get(route('admins.registrations.index', [
        'search' => 'Siti',
        'status' => StudentRegistration::STATUS_ACCEPTED,
    ]));

    $response
        ->assertSuccessful()
        ->assertSee('Siti Accepted')
        ->assertDontSee('Siti Pending')
        ->assertDontSee('Budi Rejected')
        ->assertSee('value="Siti"', false)
        ->assertViewHas('statistics', fn ($statistics): bool => (int) $statistics->total === 3
            && (int) $statistics->pending === 1
            && (int) $statistics->accepted === 1
            && (int) $statistics->rejected === 1)
        ->assertViewHas('registrations', fn ($registrations): bool => $registrations->total() === 1);
});

test('registration dashboard searches complete and partial applicant names', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    StudentRegistration::create(studentRegistrationPayload(['student_name' => 'Siti Nurhaliza']));
    StudentRegistration::create(studentRegistrationPayload(['student_name' => 'Siti Aminah']));
    StudentRegistration::create(studentRegistrationPayload(['student_name' => 'Budi Santoso']));

    $this->actingAs($admin)
        ->get(route('admins.registrations.index', ['search' => 'Siti Nurhaliza']))
        ->assertSuccessful()
        ->assertSee('Siti Nurhaliza')
        ->assertDontSee('Siti Aminah')
        ->assertDontSee('Budi Santoso');

    $this->get(route('admins.registrations.index', ['search' => 'Siti']))
        ->assertSuccessful()
        ->assertSee('Siti Nurhaliza')
        ->assertSee('Siti Aminah')
        ->assertDontSee('Budi Santoso');

    $this->get(route('admins.registrations.index', ['search' => 'Nama Yang Tidak Ada']))
        ->assertSuccessful()
        ->assertSee('Tidak ada pendaftar yang sesuai dengan pencarian atau filter.');
});

test('registration dashboard filters by every supported status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $registrationsByStatus = [
        StudentRegistration::STATUS_PENDING => 'Pendaftar Pending',
        StudentRegistration::STATUS_ACCEPTED => 'Pendaftar Diterima',
        StudentRegistration::STATUS_REJECTED => 'Pendaftar Ditolak',
    ];

    foreach ($registrationsByStatus as $status => $studentName) {
        StudentRegistration::create(studentRegistrationPayload([
            'student_name' => $studentName,
            'status' => $status,
        ]));
    }

    foreach ($registrationsByStatus as $status => $expectedName) {
        $response = $this->actingAs($admin)
            ->get(route('admins.registrations.index', ['status' => $status]));

        $response->assertSuccessful()->assertSee($expectedName);

        foreach ($registrationsByStatus as $otherStatus => $otherName) {
            if ($otherStatus !== $status) {
                $response->assertDontSee($otherName);
            }
        }
    }
});

test('registration pagination preserves name and status filters', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    for ($index = 1; $index <= 17; $index++) {
        StudentRegistration::create(studentRegistrationPayload([
            'student_name' => 'Pendaftar Pagination '.$index,
            'status' => StudentRegistration::STATUS_PENDING,
        ]));
    }

    $query = [
        'search' => 'Pendaftar Pagination',
        'status' => StudentRegistration::STATUS_PENDING,
    ];

    $this->actingAs($admin)
        ->get(route('admins.registrations.index', $query))
        ->assertSuccessful()
        ->assertSee('search=Pendaftar', false)
        ->assertSee('status=pending', false)
        ->assertSee('page=2', false);

    $this->get(route('admins.registrations.index', [...$query, 'page' => 2]))
        ->assertSuccessful()
        ->assertViewHas('registrations', fn ($registrations): bool => $registrations->currentPage() === 2
            && $registrations->total() === 17
            && $registrations->count() === 2);
});
