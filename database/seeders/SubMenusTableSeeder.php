<?php

namespace Database\Seeders;

use App\Models\SubMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Menu',
            'order_no' => 1,
            'route' => 'menu.index',
            'description' => 'Sub Menu Menu',
            'is_active' => 1,
            'permission_id' => 1,
        ]);
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Sub Menu',
            'order_no' => 2,
            'route' => 'submenu.index',
            'description' => 'Sub Menu Sub Menu',
            'is_active' => 1,
            'permission_id' => 5,
        ]);
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Role',
            'order_no' => 3,
            'route' => 'role.index',
            'description' => 'Sub Menu Role',
            'is_active' => 1,
            'permission_id' => 9,
        ]);
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Permission',
            'order_no' => 4,
            'route' => 'permission.index',
            'description' => 'Sub Menu Permission',
            'is_active' => 1,
            'permission_id' => 13,
        ]);
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Akses Role',
            'order_no' => 5,
            'route' => 'akses-role.index',
            'description' => 'Sub Menu Akses Role',
            'is_active' => 1,
            'permission_id' => 17,
        ]);
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'Akses User',
            'order_no' => 6,
            'route' => 'akses-user.index',
            'description' => 'Sub Menu Akses User',
            'is_active' => 1,
            'permission_id' => 21,
        ]);
        SubMenu::create([
            'menu_id' => 1,
            'name' => 'User',
            'order_no' => 7,
            'route' => 'user.index',
            'description' => 'Sub Menu User',
            'is_active' => 1,
            'permission_id' => 25,
        ]);
    }
}
