<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // =========================
    // 購入画面表示
    // =========================
    public function show(Item $item)
    {
        $user = Auth::user();

        if ($item->is_sold) {
            return back()->with('error', 'この商品は売り切れです。');
        }

        $address = Address::where('user_id', $user->id)->first();

        session(['purchase_item_id' => $item->id]);

        return view('purchase.show', compact('item', 'address'));
    }

    // =========================
    // 住所編集画面
    // =========================
    public function addressEdit(Item $item)
    {
        session(['purchase_item_id' => $item->id]);

        $address = Address::where('user_id', Auth::id())->first();

        return view('purchase.address_edit', compact('item', 'address'));
    }

    // =========================
    // 住所更新
    // =========================
    public function addressUpdate(Request $request, Item $item)
    {
        $request->validate([
            'postal_code' => 'required',
            'address'     => 'required',
            'building'    => 'nullable',
        ]);

        $user = Auth::user();

        Address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code' => $request->postal_code,
                'address'     => $request->address,
                'building'    => $request->building,
            ]
        );

        return redirect()
            ->route('purchase.show',session('purchase_item_id'))
            ->with('message', '住所を更新しました');
    }

    // =========================
    // 購入確定
    // =========================
    public function complete(Request $request, Item $item)
    {
        // 住所が無ければ買えない
        $address = Address::where('user_id', Auth::id())->first();

        if (!$address || empty($address->postal_code) || empty($address->address)) {
            return back()->withErrors([
                'address' => '住所が登録されていないため購入できません。住所を登録してください。'
            ])->withInput();
        }

        // 支払い方法チェック
        $request->validate(
            ['payment_method' => 'required'],
            ['payment_method.required' => '支払い方法を選択してください。']
        );

        $user = Auth::user();

        // SOLD処理
        $item->is_sold  = true;
        $item->buyer_id = $user->id;
        $item->save();

        $payment_method = $request->payment_method;

        return view('purchase.complete',
            compact('item', 'address', 'payment_method')
        );
    }
}