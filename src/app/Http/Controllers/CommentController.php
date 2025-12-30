<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ],[
            'comment.required' => 'コメントを入力してください。',
            'comment.max' => 'コメントは255文字以内で入力してください。',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'コメントを投稿しました。');
    }
}
