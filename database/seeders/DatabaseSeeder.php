<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['superadmin', 'admin', 'doctor', 'patient'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
