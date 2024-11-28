<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin' => [
                'users:rw',
                'invoices:rw',
                'cars:rw',
                'roles:rw'
            ],
            'Accounter' => [
                'users:ro',
                'invoices:rw',
                'cars:ro',
            ],
            'Driver' => [
                'users:ro',
                'cars:ro',
            ],
            'Office Worker' => [
                'users:ro',
                'invoices:rw',
                'cars:rw'
            ]
        ];

        foreach ($roles as $role => $abilities) {
            Role::factory()
                ->sequence([
                    'name' => $role,
                    'abilities' => implode('|', $abilities)
                ])
                ->create();
        }
    }
}
