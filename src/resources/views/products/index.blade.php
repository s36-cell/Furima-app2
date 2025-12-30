@extends('layouts.app')

@section('content')

<div class="product-container">

    @foreach ($products as $product)
        <a href="{{ route('products.show', $product->id) }}" class="product-card">

            <div class="image-wrapper">
                @if($product->is_sold)
                    <span class="sold-badge">SOLD</span>
                @endif

                <img src="{{ asset($product->image_path) }}" class="product-image">
            </div>

            <div class="product-info">
                <p class="product-name">{{ $product->name }}</p>
                <p class="product-price">¥{{ number_format($product->price) }}</p>
            </div>

        </a>
    @endforeach

</div>

@endsection