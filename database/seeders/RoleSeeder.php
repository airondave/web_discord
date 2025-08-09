<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Tarnished',
                'description' => 'Entry-level role for new members',
                'is_active' => true
            ],
            [
                'name' => 'RC Supremacy',
                'description' => 'Advanced role for experienced members',
                'is_active' => true
            ],
            [
                'name' => 'Tempest',
                'description' => 'Elite role with special privileges',
                'is_active' => true
            ],
            [
                'name' => 'Postmortal',
                'description' => 'High-tier role for veteran members',
                'is_active' => true
            ],
            [
                'name' => 'Razorvine',
                'description' => 'Exclusive role for top contributors',
                'is_active' => true
            ],
            [
                'name' => 'Peers',
                'description' => 'Leadership role for community peers',
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        echo "✅ Default roles created:\n";
        foreach ($roles as $role) {
            echo "   - {$role['name']}\n";
        }
    }
}
