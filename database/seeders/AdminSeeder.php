<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('ciptaju.admin_email');
        $password = config('ciptaju.admin_password');

        if (! $email || ! $password) {
            throw new RuntimeException(
                'ADMIN_EMAIL and ADMIN_PASSWORD must be configured in .env'
            );
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrator',
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}