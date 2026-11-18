<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin',     'email' => 'admin@kampus.test',     'role' => 'admin'],
            ['name' => 'Dosen',     'email' => 'dosen@kampus.test',     'role' => 'dosen'],
            ['name' => 'Mahasiswa', 'email' => 'mahasiswa@kampus.test', 'role' => 'mahasiswa'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name'     => $u['name'],
                    'password' => Hash::make('password'),
                    'role'     => $u['role'],
                ]
            );
        }
    }
}