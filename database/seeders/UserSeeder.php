<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('1234'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'Petugas',
        'email' => 'petugas@gmail.com',
        'password' => Hash::make('12345'),
        'role' => 'user',
    ]);
}
}
