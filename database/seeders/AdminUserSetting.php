<?php

namespace Database\Seeders;

use App\Models\UsersAppSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSetting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsersAppSetting::updateOrInsert([
            'dark_mode' => 'FALSE',
            'topbar_bg' => '#fff',
            'sidebar_bg' => '#474E68',
            'sidebar_title_name' => 'Larawise',
            'footer_company_name' => 'Larawise'
        ]);
    }
}
