<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            // 出品者
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 商品情報
            $table->string('name');          // 商品名
            $table->integer('price');        // 価格
            $table->string('brand')->nullable(); // ブランド（任意）
            $table->text('description');     // 商品説明
            $table->string('image_path');    // 商品画像
            $table->string('condition');     // 商品状態
            $table->boolean('is_sold')->default(false); // Sold判定

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};