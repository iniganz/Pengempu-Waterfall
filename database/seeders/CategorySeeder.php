<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
       Category::insert([
        [
            'name' => 'PC Games',
            'slug' => 'pc-games',
        ],
        [
            'name' => 'Mobile Games',
            'slug' => 'mobile-games',
        ],
        [
            'name' => 'Art Games',
            'slug' => 'art-games',
        ],
    ]);
    }
}
