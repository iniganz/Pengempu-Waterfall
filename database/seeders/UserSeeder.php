<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'MrSumping',
            'username' => 'mrsumping',
            'email' => 'gandhigunadi7@gmail.com',
            'password' => Hash::make('12345'), // Ganti dengan password yang Anda inginkan
            // 'is_admin' => true,
        ]);
    }
}
