<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 出品した商品
        $sellItems = \App\Models\Item::where('user_id', $user->id)
            ->latest()
            ->get();

        // 購入した商品
        $buyItems = \App\Models\Item::where('buyer_id', $user->id)
            ->where('is_sold', true)
            ->latest()
            ->get();

        // マイリスト（いいね）
        $likeItems = $user->likes()
            ->with('item')
            ->get()
            ->pluck('item');   // item だけ取り出す

        return view('mypage.index', compact(
            'user',
            'sellItems',
            'buyItems',
            'likeItems'
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('mypage.profile', compact('user'));
    }

    public function buy()
    {
        $user = auth()->user();
        $items = \App\Models\Item::where('buyer_id', $user->id)
            ->where('is_sold', true)
            ->latest()
            ->get();

        return view('mypage.buy', compact('items'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('mypage.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'name'        => 'required|string|max:20',
            'email'       => 'required|email',
            'postal_code' => 'nullable|regex:/^\d{3}-\d{4}$/',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|regex:/^[0-9-]+$/',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_image')){
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->postal_code = $request->postal_code;
        $user->address     = $request->address;
        $user->phone       = $request->phone;

        $user->save();

        return redirect()->route('mypage.profile')
            ->with('message', 'プロフィールを更新しました');
    }

    public function sell()
    {
        $user = auth()->user();

        $items = \App\Models\Item::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('mypage.sell', compact('items'));
    }
}