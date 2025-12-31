@extends('layouts.app')

@section('content')
<div class="mypage-container">

    <div class="mypage-header">
        <img src="{{ asset('storage/' . ($user->profile_image ?? 'default.png')) }}" class="mypage-icon">
        <h2>{{ $user->name }}</h2>

        <a href="{{ route('mypage.edit') }}" class="profile-edit-btn">
            プロフィールを編集
        </a>
    </div>

    {{-- ======== タブ ======== --}}
    <div class="mypage-tabs">
        <button class="tab-btn active" data-target="sell">出品した商品</button>
        <button class="tab-btn" data-target="buy">購入した商品</button>
    </div>

    {{-- ======== 出品した商品 ======== --}}
    <div id="sell" class="tab-content active">

        @if($sellItems->isEmpty())
            <p>まだ出品した商品はありません</p>
        @else
            <div class="item-list">
                @foreach($sellItems as $item)
                    <div class="item-card">
                        <img src="{{ asset('storage/' . $item->image_path) }}">
                        <p>{{ $item->name }}</p>
                        <p>¥{{ number_format($item->price) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ======== 購入した商品 ======== --}}
    <div id="buy" class="tab-content">

        @if($buyItems->isEmpty())
            <p>まだ購入した商品はありません</p>
        @else
            <div class="item-list">
                @foreach($buyItems as $item)
                    <div class="item-card">
                        <img src="{{ asset('storage/' . $item->image_path) }}">
                        <p>{{ $item->name }}</p>
                        <p>¥{{ number_format($item->price) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>



@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            // ボタンの active を切替
            document.querySelectorAll('.tab-btn')
                .forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // コンテンツの active 切替
            document.querySelectorAll('.tab-content')
                .forEach(c => c.classList.remove('active'));

            document.getElementById(this.dataset.target)
                .classList.add('active');
        });
    });

});
</script>

