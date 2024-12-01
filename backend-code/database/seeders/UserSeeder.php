<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\Models\User\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => Role::ADMIN->value,
        ]);

        User::create([
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('123456'),
            'role' => Role::DOCTOR->value,
        ]);

        User::create([
            'email' => 'patient@gmail.com',
            'password' => Hash::make('123456'),
            'role' => Role::PATIENT->value,
        ]);
    }
}
