<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ItemStoreRequest;

class ItemController extends Controller
{
    // 商品一覧
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        //検索クエリ
        $query = Item::query();

        if ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }
        //並び替え＆取得
        $items = $query->latest()->get();

        //いいねitem_idを配列で取得(未ログイン空)
        $likes = [];
        if (auth()->check()) {
            $likes = auth()->user()
                ->likes()
                ->pluck('item_id')
                ->toArray();
        }

        return view('items.index', compact('items', 'likes', 'keyword'));

    }

    // 商品詳細
    public function show(Item $item)
    {
        $item->load('categories', 'user');

        return view('items.show', compact('item'));
    }

    // 出品画面表示
    public function create()
    {
        // カテゴリを全部とってきてチップで表示
        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    // 出品登録処理
    public function store(ItemStoreRequest $request)
    {

        // 画像アップロード
        $path = $request->file('image')->store('item_images', 'public');

        // items テーブルに保存
        $item = Item::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'image_path'  => $path,
            'description' => $request->description,
            'brand_name'  => $request->brand_name,
            'condition'   => $request->condition,
            'user_id'     => Auth::id(),
            'is_sold'     => false,
        ]);

        // 中間テーブルにカテゴリを保存
        $item->categories()->sync($request->categories);

        return redirect()
            ->route('items.index')
            ->with('message', '商品を出品しました！');
    }
}