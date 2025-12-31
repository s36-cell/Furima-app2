<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        // 🔥 外部キー停止
        Schema::disableForeignKeyConstraints();

        // 🔥 先に中間テーブル削除
        DB::table('category_item')->truncate();

        // 🔥 items 削除
        Item::truncate();

        // 🔥 外部キー再開
        Schema::enableForeignKeyConstraints();

        // ⭐ ユーザー保証
        $user = User::first() ?? User::factory()->create([
            'name'  => 'testuser',
            'email' => 'test@example.com',
        ]);

        $items = [
            [
                'name' => '腕時計',
                'price' => 15000,
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image_path' => 'items/watch.jpg',
                'condition' => '良好',
                'is_sold' => false,
                'categories' => ['ファッション'],
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image_path' => 'items/hdd.jpg',
                'condition' => '目立った傷や汚れなし',
                'is_sold' => false,
                'categories' => ['家電'],
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand' => null,
                'description' => '新鮮な玉ねぎ3束のセット',
                'image_path' => 'items/onion.jpg',
                'condition' => 'やや傷や汚れあり',
                'is_sold' => false,
                'categories' => ['食品'],
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'brand' => null,
                'description' => 'クラシックなデザインの革靴',
                'image_path' => 'items/shoes.jpg',
                'condition' => '状態が悪い',
                'is_sold' => false,
                'categories' => ['ファッション'],
            ],
            [
                'name' => 'ノートPC',
                'price' => 45000,
                'brand' => null,
                'description' => '高性能なノートパソコン',
                'image_path' => 'items/laptop.jpg',
                'condition' => '良好',
                'is_sold' => false,
                'categories' => ['家電'],
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'brand' => null,
                'description' => '高音質のレコーディング用マイク',
                'image_path' => 'items/mic.jpg',
                'condition' => '目立った傷や汚れなし',
                'is_sold' => false,
                'categories' => ['家電'],
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand' => null,
                'description' => 'おしゃれなショルダーバッグ',
                'image_path' => 'items/bag.jpg',
                'condition' => 'やや傷や汚れあり',
                'is_sold' => true,
                'categories' => ['ファッション'],
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'brand' => null,
                'description' => '使いやすいタンブラー',
                'image_path' => 'items/tumbler.jpg',
                'condition' => '状態が悪い',
                'is_sold' => false,
                'categories' => ['日用品'],
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 4000,
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'image_path' => 'items/coffeemill.jpg',
                'condition' => '良好',
                'is_sold' => false,
                'categories' => ['日用品'],
            ],
            [
                'name' => 'メイクセット',
                'price' => 2500,
                'brand' => null,
                'description' => '便利なメイクアップセット',
                'image_path' => 'items/makeup.jpg',
                'condition' => '目立った傷や汚れなし',
                'is_sold' => false,
                'categories' => ['コスメ'],
            ],
        ];

        foreach ($items as $data) {

            $item = Item::create([
                'user_id'     => $user->id,
                'name'        => $data['name'],
                'price'       => $data['price'],
                'brand'       => $data['brand'],
                'description' => $data['description'],
                'image_path'  => $data['image_path'],
                'condition'   => $data['condition'],
                'is_sold'     => $data['is_sold'],
            ]);

            $item->categories()->sync(
                Category::whereIn('name', $data['categories'])->pluck('id')
            );
        }
    }
}