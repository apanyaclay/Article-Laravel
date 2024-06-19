<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'name' => 'Configuration',
            'icon' => 'fas fa-cog',
            'order_no' => 1,
            'route' => '#',
            'description' => 'Menu Konfigurasi',
            'is_active' => 1,
        ]);
        Menu::create([
            'name' => 'Article',
            'icon' => 'fas fa-newspaper',
            'order_no' => 2,
            'route' => 'post.index',
            'description' => 'Menu Artikel',
            'is_active' => 1,
            'permission_id' => 33,
        ]);
        Menu::create([
            'name' => 'Log Out',
            'icon' => 'fas fa-sign-out-alt',
            'order_no' => 3,
            'route' => 'logout',
            'description' => 'Menu Logout',
            'is_active' => 1,
        ]);
    }
}
