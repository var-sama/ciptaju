<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('admin dashboard displays registered users and their latest login', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $registeredAt = now()->subDays(3)->startOfMinute();
    $lastLoginAt = now()->subHour()->startOfMinute();
    $user = User::factory()->create([
        'created_at' => $registeredAt,
        'last_login_at' => $lastLoginAt,
        'role' => 'student',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertSuccessful()
        ->assertSee($user->name)
        ->assertSee($user->email)
        ->assertSee($registeredAt->format('d/m/Y H:i'))
        ->assertSee($lastLoginAt->format('d/m/Y H:i'))
        ->assertSee('Belum pernah login')
        ->assertSee('Data tersimpan di database')
        ->assertSee('Dashboard')
        ->assertSee(route('admin.users.index'), false);
});

test('only admins can open the user dashboard and manage accounts', function () {
    $this->get(route('admin.users.index'))
        ->assertRedirect(route('auth.login'));

    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)
        ->get(route('students.index'))
        ->assertSuccessful()
        ->assertDontSee('Dashboard Admin');

    $this->actingAs($student)
        ->get(route('admin.users.index'))
        ->assertForbidden();

    $this->postJson(route('admin.users.store'), [
        'name' => 'Pengguna Baru',
        'email' => 'baru@example.test',
        'password' => 'password-123',
        'role' => 'student',
    ])->assertForbidden();

    expect(User::query()->count())->toBe(1);
});

test('admin can create update and delete database users', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    $this->postJson(route('admin.users.store'), [
        'name' => 'Pengguna Baru',
        'email' => 'baru@example.test',
        'password' => 'password-123',
        'role' => 'student',
    ])->assertCreated();

    $user = User::query()->where('email', 'baru@example.test')->firstOrFail();
    $this->assertModelExists($user);
    expect(Hash::check('password-123', $user->password))->toBeTrue();

    $this->putJson(route('admin.users.update', $user), [
        'name' => 'Nama Diperbarui',
        'email' => 'baru@example.test',
        'password' => '',
        'role' => 'teacher',
    ])->assertSuccessful();

    expect($user->refresh()->name)->toBe('Nama Diperbarui')
        ->and($user->role)->toBe('teacher')
        ->and(Hash::check('password-123', $user->password))->toBeTrue();

    $this->deleteJson(route('admin.users.destroy', $user))
        ->assertSuccessful();

    $this->assertModelMissing($user);
});

test('admin cannot remove or downgrade the last administrator', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->putJson(route('admin.users.update', $admin), [
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => '',
            'role' => 'student',
        ])
        ->assertUnprocessable();

    $this->deleteJson(route('admin.users.destroy', $admin))
        ->assertUnprocessable();

    expect($admin->refresh()->role)->toBe('admin');
});

test('registration is stored in users and successful login records the login time', function () {
    $this->post(route('auth.register.submit'), [
        'name' => 'Murid Terdaftar',
        'email' => 'murid@example.test',
        'password' => 'password-123',
        'password_confirmation' => 'password-123',
    ])->assertRedirect(route('auth.login'));

    $user = User::query()->where('email', 'murid@example.test')->firstOrFail();
    expect($user->role)->toBe('student')
        ->and($user->last_login_at)->toBeNull();

    $this->post(route('auth.login.submit'), [
        'email' => 'murid@example.test',
        'password' => 'password-123',
    ])->assertRedirect(route('students.index'));

    expect($user->refresh()->last_login_at)->not->toBeNull();
});

test('admin login redirects to the dashboard and records the login time', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.test',
        'password' => 'password-123',
        'role' => 'admin',
    ]);

    $this->post(route('auth.login.submit'), [
        'email' => $admin->email,
        'password' => 'password-123',
    ])->assertRedirect(route('admin.users.index'));

    expect($admin->refresh()->last_login_at)->not->toBeNull();
});
