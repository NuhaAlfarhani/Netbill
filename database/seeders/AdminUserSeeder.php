<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@billing.com'],
            [
                'username' => 'admin',
                'email' => 'admin@billing.com',
                'password' => Hash::make('admin'),
            ]
        );

        $admin->assignRole('Admin');
    }
}
