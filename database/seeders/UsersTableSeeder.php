<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name"=> "Super Admin",
            "email"=> "superadmin@example.com",
            "password"=> Hash::make('password'),
        ]);
        $user->assignRole('super admin');
        $user = User::create([
            "name"=> "Admin",
            "email"=> "admin@example.com",
            "password"=> Hash::make('password'),
        ]);
        $user->assignRole('admin');
        $user = User::create([
            "name"=> "Publisher",
            "email"=> "publisher@example.com",
            "password"=> Hash::make('password'),
        ]);
        $user->assignRole('publisher');
        $user = User::create([
            "name"=> "Writer",
            "email"=> "writer@example.com",
            "password"=> Hash::make('password'),
        ]);
        $user->assignRole('writer');
        $user = User::create([
            "name"=> "User",
            "email"=> "user@example.com",
            "password"=> Hash::make('password'),
        ]);
        $user->assignRole('user');
    }
}
