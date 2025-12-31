<div class="items-container">
@foreach($items as $item)
    <div class="item-card">

        {{-- 商品詳細リンク --}}
        <a href="{{ route('items.show', $item) }}">
            <div class="item-image">
                <img src="{{ asset('storage/' . $item->image_path) }}"
                    alt="{{ $item->name }}">

                {{-- ❤️ いいね済み --}}
                @if(isset($likes) && in_array($item->id, $likes))
                    <span class="like-badge">❤️</span>
                @endif

                {{-- SOLD表示 --}}
                @if($item->is_sold)
                    <span class="sold-badge">SOLD</span>
                @endif
            </div>
        </a>

        {{-- 商品名 + いいね表示 --}}
        <p class="item-name">
            {{ $item->name }}

        </p>

        {{-- 価格 --}}
        <p class="item-price">
            ¥{{ number_format($item->price) }}
        </p>

    </div>

@endforeach
</div>