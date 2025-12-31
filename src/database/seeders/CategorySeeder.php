<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // ⭐ 外部キー制約 OFF
        Schema::disableForeignKeyConstraints();

        Category::truncate();

        Category::insert([
            ['name' => '家電'],
            ['name' => 'ファッション'],
            ['name' => '食品'],
            ['name' => '日用品'],
            ['name' => 'コスメ'],
            ['name' => 'その他'],
        ]);

        // ⭐ 外部キー制約 ON
        Schema::enableForeignKeyConstraints();
    }
}