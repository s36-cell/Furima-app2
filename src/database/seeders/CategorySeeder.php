<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::truncate();

        Category::insert([
            ['name' => '家電'],
            ['name' => 'ファッション'],
            ['name' => '食品'],
            ['name' => '日用品'],
            ['name' => 'コスメ'],
            ['name' => 'その他'],
        ]);
    }
}