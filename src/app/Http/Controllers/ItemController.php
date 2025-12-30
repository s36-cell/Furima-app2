<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // ====== 商品一覧 ======
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $query = Item::query();

        if ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        $items = $query->latest()->get();

        return view('items.index', compact('items', 'keyword'));
    }

    // ====== 商品詳細 ======
    public function show(Item $item)
    {
        $item->load('categories');
        return view('items.show', compact('item'));
    }

    // ====== 出品画面 ======
    public function create()
    {
        return view('items.create');
    }

    // ====== 出品登録 ======
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('item_images', 'public');

        Item::create([
            'name'       => $request->name,
            'price'      => $request->price,
            'image_path' => $path,
            'user_id'    => Auth::id(),
            'is_sold'    => false,
        ]);

        return redirect()->route('items.index')
            ->with('message', '出品しました！');
    }
}