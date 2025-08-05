<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Moamen Rabee Mohamed',
            'email' => 'moamenrabee7@gmail.com',
            'password' => Hash::make('moamen123'),
            'email_verified_at' => now(),
        ]);
    }
}
