@extends('layouts.app')

@section('content')

<div class="mypage-wrapper">
<div class="container">
    <h2>マイページ</h2>

    <p>{{ $user->name }} さん、こんにちは！</p>

    <ul>
        <li><a href="{{ route('mypage.profile') }}">プロフィールを見る</a></li>
        <li><a href="{{ route('mypage.buy') }}">購入した商品</a></li>
        <li><a href="{{ route('mypage.sell') }}">出品した商品</a></li>
    </ul>
</div>
</div>

@endsection