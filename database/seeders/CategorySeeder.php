<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'PC Games', 'slug' => 'pc-games'],
            ['name' => 'Mobile Games', 'slug' => 'mobile-games'],
            ['name' => 'Art Games', 'slug' => 'art-games'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']], // kondisi pencarian
                $category // data untuk update atau create
            );
        }
    }
}
