@extends('layouts.app')

@section('content')

<div class="product-detail">

    <div class="detail-image">
        <img src="{{ asset($product->image_path) }}">
    </div>

    <div class="detail-info">

        <h2>{{ $product->name }}</h2>

        <p class="detail-price">
            ¥{{ number_format($product->price) }}
        </p>

        <p class="detail-condition">
            状態：{{ $product->condition }}
        </p>

        <p class="detail-description">
            {{ $product->description }}
        </p>

        @if($product->is_sold)
            <p class="detail-sold">売り切れました</p>
        @endif

    </div>

</div>

@endsection