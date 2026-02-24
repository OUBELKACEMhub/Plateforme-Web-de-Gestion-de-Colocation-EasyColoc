<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin EasyColoc',
            'email' => 'admin@easycoloc.com',
            'password' => Hash::make('password'),
            'reputation_score' => 100,
            'is_global_admin' => true,
            'role' => 'admin',
            'is_banned' => false,
        ]);

        User::create([
            'name' => 'Ahmed Owner',
            'email' => 'owner@easycoloc.com',
            'password' => Hash::make('password'),
            'reputation_score' => 50,
            'is_global_admin' => false,
            'role' => 'owner', 
            'is_banned' => false,
        ]);

        User::create([
            'name' => 'Sara Member',
            'email' => 'member@easycoloc.com',
            'password' => Hash::make('password'),
            'reputation_score' => 10,
            'is_global_admin' => false,
            'role' => 'member', 
            'is_banned' => false,
        ]);

        User::create([
            'name' => 'Bad User',
            'email' => 'banned@easycoloc.com',
            'password' => Hash::make('password'),
            'reputation_score' => -10,
            'is_global_admin' => false,
            'role' => 'member',
            'is_banned' => true,
        ]);
    }
}