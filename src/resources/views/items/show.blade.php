@extends('layouts.app')

@section('content')

<div class="detail-container">

    <div class="detail-left">
        <img src="{{ asset('storage/' . $item->image_path) }}" class="detail-image">
        @if($item->is_sold)
            <span class="sold-badge">SOLD</span>
        @endif
    </div>

    <div class="detail-right">

        <h2 class="detail-title">{{ $item->name }}</h2>

        <p class="detail-brand">
            ブランド：
            {{ $item->brand ?? 'なし' }}
        </p>

        <p class="detail-price">
            ¥{{ number_format($item->price) }}
        </p>
    <div class="icon-area">
        {{--いいねボタン--}}
        @auth
            @if($item->isLikedBy(Auth()->user()))
                <form method="POST" action="{{ route('items.unlike',$item
                ) }}">
                    @csrf
                    @method('DELETE')
                    <button class="icon-btn">
                        <img src="{{ asset('images/logo3.png') }}" width="28">
                    </button>
                </form>
            @else
        <form method="POST" action="{{ route('items.like',$item) }}">
            @csrf
            <button class="icon-btn">
                <img src="{{ asset('images/logo2.png') }}" width="28">
            </button>
        </form>
            @endif
        @endauth
        <span>{{ $item->likes->count() }}</span>

        {{--コメントアイコン--}}
        <div class="comment-icon">
            <img src="{{ asset('images/logo4.png') }}" width="28">
            <span>{{ $item->comments->count() }}</span>
        </div>
    </div>

        {{-- 購入ボタン --}}

        @if(!$item->is_sold)
            <a href="{{ route('purchase.show', $item) }}" class="buy-btn">
                購入する
            </a>
        @else
            <div class="sold-message">この商品は売り切れました</div>
        @endif

        <p class="detail-category">
            カテゴリ：
            @if($item->categories->count())
                @foreach($item->categories as $category)
                    {{ $category->name }}
                    @if(!$loop->last)
                        /
                    @endif
                @endforeach
            @else
                なし
            @endif

        <p class="detail-condition">
            状態：{{ $item->condition }}
        </p>

        <h3 class="detail-section-title">商品説明</h3>
        <p class="detail-description">
            {{ $item->description }}
        </p>

        <hr>

        <h3>コメント</h3>

        {{-- コメント一覧 --}}
        @foreach ($item->comments as $comment)
            <p>
                <strong>{{ $comment->user->name }}</strong>
                <br>
                {{ $comment->comment }}
            </p>
            <h3>
                <img src="{{ asset('images/logo4.png') }}" width="24">
                コメント
            </h3>
        @endforeach

        {{-- コメント投稿フォーム --}}
        @if(auth()->check())
        <form action="{{ route('comments.store', $item) }}" method="POST">
            @csrf
            <textarea name="comment" rows="3" style="width:100%;" placeholder="コメントを書く..."></textarea>
            @error('comment')
                <p style="color:red;">{{ $message }}</p>
            @enderror

            <button type="submit">コメント投稿</button>
        </form>
        @endif

    </div>

</div>

@endsection