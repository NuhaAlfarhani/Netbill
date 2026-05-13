<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        $adminRole = Role::create([
            'name' => 'Admin'
        ]);

        $admin = User::create([
            'username' => 'pepe',
            'email' => 'pepe@example.com',
            'password' => Hash::make('pepe')
        ]);

        $admin->roles()->attach($adminRole);

        $this->call(RolePermission::class);
        $this->call(PackageSeeder::class);
    }
}
