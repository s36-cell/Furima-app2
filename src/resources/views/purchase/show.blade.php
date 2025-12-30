@extends('layouts.app')

@section('content')
<div class="purchase-wrapper">

    {{-- 左ブロック --}}
    <div class="purchase-left">
        <img src="{{ asset('storage/' . $item->image_path) }}" class="purchase-img">

        <div class="item-info">
            <h2>{{ $item->name }}</h2>
            <p class="price">¥{{ number_format($item->price) }}</p>
        </div>

        <hr>

        {{-- 🔥 支払い方法（左に置く！） --}}
        <label>支払い方法</label>
        <select id="payment-select"
                name="payment_method"
                form="purchase-form">
            <option value="">選択してください</option>
            <option value="コンビニ払い"
                {{ old('payment_method')=='コンビニ払い' ? 'selected' : '' }}>
                コンビニ払い

            </option>
            <option value="クレジットカード"
                {{ old('payment_method')=='クレジットカード' ? 'selected' : '' }}>
                クレジットカード
            </option>
        </select>

        @if ($errors->has('payment_method'))
            <p style="color:red;">
            {{ $errors->first('payment_method') }}
            </p>
        @endif



        <h3>配送先</h3>

        @if($address)
            <p>
                〒{{ $address->postal_code }}<br>
                {{ $address->address }}<br>
                {{ $address->building }}
            </p>
        @else
            <p>住所が登録されていません</p>
        @endif

        <a href="{{ route('purchase.address.edit', $item->id) }}">
            変更する
        </a>
    </div>



    {{-- 右ブロック（まとめ & 購入フォーム） --}}
    <div class="purchase-summary">
        <div class="summary-box">
            <p>商品代金  ¥{{ number_format($item->price) }}</p>
            <p>支払い方法：
                <span id="summary-payment">
                    {{ old('payment_method') ?? '未選択' }}
                </span>
            </p>
        </div>

        {{-- 🔥 右側フォーム（支払い方法は form= で左とリンク） --}}
        <form id="purchase-form"
                action="{{ route('purchase.complete', $item) }}"
                method="POST">
            @csrf

            <button class="detail-buy-btn">
                購入する
            </button>
        </form>
    </div>



    {{-- 支払い方法 → 右側表示 更新JS --}}
    <script>
        document.getElementById('payment-select').addEventListener('change', function () {
            let text = this.value ? this.options[this.selectedIndex].text : '未選択';
            document.getElementById('summary-payment').textContent = text;
        });
    </script>

</div>
@endsection