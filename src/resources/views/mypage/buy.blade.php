@extends('layouts.app')

@section('content')
<div class="mypage-wrapper">
    <h2>購入した商品</h2>

    {{-- 購入履歴なし --}}
    @if($items->isEmpty())
        <p>まだ購入履歴がありません</p>
    @endif

    {{-- 購入履歴あり --}}
    <div class="item-list">
        @foreach($items as $item)
            <div class="item-card">

                <img src="{{ asset('storage/' . $item->image_path) }}" width="120">

                <div>
                    <p>{{ $item->name }}</p>
                    <p>¥{{ number_format($item->price) }}</p>

                    <a href="{{ route('items.show', $item->id) }}">
                        商品を見る
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</div>
@endsection