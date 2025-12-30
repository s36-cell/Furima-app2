<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 購入画面表示
    public function show(Item $item)
    {
        $user = Auth::user();

        if ($item->is_sold) {
            return back()->with('error', 'この商品は売り切れです。');
        }

        // ★ users.address カラムではなく、addresses テーブルから取得
        $address = Address::where('user_id', $user->id)->first();

        session(['purchase_item_id' => $item->id]);

        return view('purchase.show', compact('item', 'address'));
    }

    // 住所編集画面
    public function addressEdit(Item $item)
    {
        session(['purchase_item_id' => $item->id]);

        $address = Address::where('user_id', Auth::id())->first();

        return view('purchase.address', compact('item', 'address'));
    }

    // 住所更新
    public function addressUpdate(Request $request, Item $item)
    {
        $request->validate([
            'postal_code' => 'required',
            'address'     => 'required',
            'building'    => 'nullable',
        ]);

        $user = Auth::user();

        // addressesテーブルを user_id で更新 or 作成
        Address::updateOrCreate(
            ['user_id' => $user->id],

            [
                'postal_code' => $request->postal_code,
                'address'     => $request->address,
                'building'    => $request->building,
            ]
        );

        return redirect()
            ->route('purchase.show', $item->id)
            ->with('message', '住所を更新しました');
    }

    // 購入確定
    public function complete(Request $request, Item $item)
    {
        // 支払い方法チェック
        $request->validate(
            ['payment_method' => 'required'],
            ['payment_method.required' => '支払い方法を選択してください。']
        );

        $user = Auth::user();

        // SOLD・購入者IDを更新
        $item->is_sold  = true;
        $item->buyer_id = $user->id;
        $item->save();

        // ★ ここも string ではなく Address モデルを渡す
        $address = Address::where('user_id', $user->id)->first();

        $payment_method = $request->payment_method;

        return view('purchase.complete', compact('item', 'address', 'payment_method'));
    }
}