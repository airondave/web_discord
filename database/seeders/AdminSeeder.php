<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::create([
            'username' => 'admin',
            'password' => 'admin123', // Will be hashed automatically
            'name' => 'Administrator',
            'is_active' => true,
        ]);

        // Create another admin user
        Admin::create([
            'username' => 'superadmin',
            'password' => 'superadmin123', // Will be hashed automatically
            'name' => 'Super Administrator',
            'is_active' => true,
        ]);

        echo "✅ Default admin users created:\n";
        echo "   Username: admin, Password: admin123\n";
        echo "   Username: superadmin, Password: superadmin123\n";
    }
}
