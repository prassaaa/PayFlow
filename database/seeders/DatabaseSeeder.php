<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Create default admin user
        $admin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@payflow.com',
        ]);
        
        $admin->assignRole('super_admin');

        // Create test users for different roles
        $hrManager = User::factory()->create([
            'name' => 'HR Manager',
            'email' => 'hr@payflow.com',
        ]);
        $hrManager->assignRole('hr_manager');

        $finance = User::factory()->create([
            'name' => 'Finance User',
            'email' => 'finance@payflow.com',
        ]);
        $finance->assignRole('finance');

        $employee = User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@payflow.com',
        ]);
        $employee->assignRole('employee');
    }
}
