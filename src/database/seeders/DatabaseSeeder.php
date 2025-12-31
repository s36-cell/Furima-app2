<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🔥 外部キー制約を一時的に OFF
        Schema::disableForeignKeyConstraints();

        // 🔥 users を初期化（重複エラー防止）
        User::truncate();

        // ⭐ テストユーザー作成
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 🔥 外部キー制約を ON に戻す
        Schema::enableForeignKeyConstraints();

        // ⭐ 他 Seeder 実行
        $this->call([
            CategorySeeder::class,
            ItemSeeder::class,
        ]);
    }
}