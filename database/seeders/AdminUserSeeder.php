<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Patrick Lester Punzalan',
            'first_name' => 'Patrick Lester',
            'last_name' => 'Punzalan',
            'contact' => '09162097072',
            'email' => 'punzalan2233@gmail.com',
            'password' => Hash::make('qwerty'),
            'status' => 'ACTIVE',
            'created_by' => 1,
        ]);

        User::create([
            'name' => 'Fillinor Gunio',
            'first_name' => 'Fillinor',
            'last_name' => 'Gunio',
            'contact' => '09763896443',
            'email' => 'filongunio@gmail.com',
            'password' => Hash::make('qwerty'),
            'status' => 'ACTIVE',
            'created_by' => 1,
        ]);
    }
}
