<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperadminSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Super',
            "last_name" => 'Admin',
            'pesel' => '00000000000',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);

        $role = Role::firstOrCreate(['name' => 'superadmin']);
        $user->assignRole($role);

        echo "Superadmin created successfully.\n";
    }
}
