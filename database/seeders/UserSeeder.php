<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'user_type' => \App\Models\User::TYPE_ADMIN,
        ]);

        User::create([
            'name' => 'Jogador Comum',
            'email' => 'user1@teste.com',
            'password' => Hash::make('user123'),
            'user_type' => 0,
        ]);

        User::create([
            'name' => 'Visitante',
            'email' => 'user2@teste.com',
            'password' => Hash::make('user123'),
            'user_type' => 0,
        ]);
    }
}
