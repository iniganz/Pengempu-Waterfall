<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['name' => 'Windows', 'slug' => 'windows'],
            ['name' => 'PlayStation', 'slug' => 'playstation'],
            ['name' => 'Xbox', 'slug' => 'xbox'],
            ['name' => 'Android', 'slug' => 'android'],
            ['name' => 'iOS', 'slug' => 'ios'],
            ['name' => 'Nintendo Switch', 'slug' => 'nintendo-switch'],
            ['name' => 'Linux', 'slug' => 'linux'],
            ['name' => 'macOS', 'slug' => 'macos'],
            ['name' => 'Web', 'slug' => 'web'],
            ['name' => 'VR', 'slug' => 'vr'],
            ['name' => 'Steam' , 'slug' => 'steam'],
            ['name' => 'Epic Games Store', 'slug' => 'epic-games-store'],
            ['name' => 'GOG', 'slug' => 'gog'],
            ['name' => 'Origin', 'slug' => 'origin'],
            ['name' => 'Uplay', 'slug' => 'uplay'],
            ['name' => 'Battle.net', 'slug' => 'battle-net'],
        ];
        foreach ($platforms as $p) {
            Platform::create($p);
        }
    }
}
