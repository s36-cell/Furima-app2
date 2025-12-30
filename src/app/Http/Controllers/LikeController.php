<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // いいねする
    public function store(Item $item, Request $request)
    {
        $user = $request->user(); // = auth()->user()
        if (!$item->isLikedBy($user)) {
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
        }

        // 元のページに戻す
        return back();
    }

    // いいねを外す
    public function destroy(Item $item, Request $request)
    {
        $user = $request->user();

        Like::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->delete();

        return back();
    }
}