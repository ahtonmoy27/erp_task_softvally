<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'HR User',
                'email' => 'hr@example.com',
                'role' => 'HR',
            ],
            [
                'name' => 'HR Manager User',
                'email' => 'hrmanager@example.com',
                'role' => 'hrmanager',
            ],
            [
                'name' => 'Director Finance User',
                'email' => 'director.finance@example.com',
                'role' => 'director',
            ],
            [
                'name' => 'CFO User',
                'email' => 'cfo@example.com',
                'role' => 'CFO',
            ],
            [
                'name' => 'CEO User',
                'email' => 'ceo@example.com',
                'role' => 'CEO',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => Hash::make('123456'),
                'department_id' => null,
                'is_on_leave' => false,
            ]);
        }
    }  
}
