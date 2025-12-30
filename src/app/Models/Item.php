<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;

class Item extends Model
{
    use HasFactory;

    /**
     * 一括代入を許可するカラム
     */
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'brand',
        'description',
        'image_path',
        'condition',
        'is_sold',
    ];
    protected $casts = [
        'is_sold' => 'boolean',
    ];

    /**
     * 出品者（User）とのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * カテゴリ（Category）とのリレーション
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * コメント（Comment）とのリレーション
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes')
            ->withTimestamps();
    }
    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}