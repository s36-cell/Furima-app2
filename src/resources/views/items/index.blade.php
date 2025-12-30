@extends('layouts.app')

@section('content')
<h2 class="page-title">商品一覧</h2>

<div class="items-container">
    @foreach($items as $item)
        <div class="item-card">
            <a href="{{ route('items.show', $item) }}">
                <div class="item-image">
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">

                    @if($item->is_sold)
                        <span class="sold-badge">SOLD</span>
                    @endif
                </div>

                <p class="item-name">{{ $item->name }}</p>
                <p class="item-price">¥{{ number_format($item->price) }}</p>
            </a>
        </div>
    @endforeach
</div>
@endsection