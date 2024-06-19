<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            "name"=> "super admin",
        ]);
        Role::create([
            "name"=> "admin",
        ]);
        Role::create([
            "name"=> "publisher",
        ]);
        Role::create([
            "name"=> "writer",
        ]);
        Role::create([
            "name"=> "user",
        ]);
        Permission::create([
            "name"=> "view menu",
        ]);
        Permission::create([
            "name"=> "create menu",
        ]);
        Permission::create([
            "name"=> "update menu",
        ]);
        Permission::create([
            "name"=> "delete menu",
        ]);
        Permission::create([
            "name"=> "view submenu",
        ]);
        Permission::create([
            "name"=> "create submenu",
        ]);
        Permission::create([
            "name"=> "update submenu",
        ]);
        Permission::create([
            "name"=> "delete submenu",
        ]);
        Permission::create([
            "name"=> "view role",
        ]);
        Permission::create([
            "name"=> "create role",
        ]);
        Permission::create([
            "name"=> "update role",
        ]);
        Permission::create([
            "name"=> "delete role",
        ]);
        Permission::create([
            "name"=> "view permission",
        ]);
        Permission::create([
            "name"=> "create permission",
        ]);
        Permission::create([
            "name"=> "update permission",
        ]);
        Permission::create([
            "name"=> "delete permission",
        ]);
        Permission::create([
            "name"=> "view akses-role",
        ]);
        Permission::create([
            "name"=> "create akses-role",
        ]);
        Permission::create([
            "name"=> "update akses-role",
        ]);
        Permission::create([
            "name"=> "delete akses-role",
        ]);
        Permission::create([
            "name"=> "view akses-user",
        ]);
        Permission::create([
            "name"=> "create akses-user",
        ]);
        Permission::create([
            "name"=> "update akses-user",
        ]);
        Permission::create([
            "name"=> "delete akses-user",
        ]);
        Permission::create([
            "name"=> "view user",
        ]);
        Permission::create([
            "name"=> "create user",
        ]);
        Permission::create([
            "name"=> "update user",
        ]);
        Permission::create([
            "name"=> "delete user",
        ]);
        Permission::create([
            "name"=> "view setting",
        ]);
        Permission::create([
            "name"=> "create setting",
        ]);
        Permission::create([
            "name"=> "update setting",
        ]);
        Permission::create([
            "name"=> "delete setting",
        ]);
        Permission::create([
            "name"=> "view articles",
        ]);
        Permission::create([
            "name"=> "create articles",
        ]);
        Permission::create([
            "name"=> "update articles",
        ]);
        Permission::create([
            "name"=> "delete articles",
        ]);
    }
}
