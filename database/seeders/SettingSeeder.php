<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['key' => 'site_name', 'value' => 'My Awesome Site', 'description' => 'Nama situs web']);
        Setting::create(['key' => 'site_logo', 'value' => 'assets/dist/img/AdminLTELogo.png', 'description' => 'Nama situs web']);
        Setting::create(['key' => 'site_author', 'value' => 'ApanyaClay', 'description' => 'Nama author']);
        Setting::create(['key' => 'site_email', 'value' => 'admin@example.com', 'description' => 'Email situs web']);
        Setting::create(['key' => 'site_maintenance', 'value' => '0', 'description' => 'Mode perawatan situs web']);
        Setting::create(['key' => 'meta_description', 'value' => 'Your meta description here', 'description' => 'Your meta description here']);
        Setting::create(['key' => 'meta_keywords', 'value' => 'keyword1, keyword2, keyword3', 'description' => 'Your meta keywords here']);
    }
}
