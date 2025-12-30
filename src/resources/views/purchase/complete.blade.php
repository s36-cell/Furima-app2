@extends('layouts.app')

@section('content')
<div class="thanks-wrapper">

    <h2>購入が完了しました！</h2>

    <p>{{ $item->name }}</p>
    <p>¥{{ number_format($item->price) }}</p>

    <p>配送先</p>

    @if($address)
        <p>
            〒{{ $address->postal_code }}<br>
            {{ $address->address }} {{ $address->building }}
        </p>
    @else
        <p>住所情報がありません</p>
    @endif

    @isset($payment_method)
        <p>支払い方法：{{ $payment_method }}</p>
    @endisset

    <a href="{{ route('items.index') }}" class="btn">
        商品一覧へ戻る
    </a>

</div>
@endsection