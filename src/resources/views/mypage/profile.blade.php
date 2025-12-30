@extends('layouts.app')

@section('content')

<div class="profile-wrapper">

    <h2 class="title">プロフィール</h2>

    <div class="profile-card">

        {{-- アイコン（画像無いならグレー丸） --}}
        <div class="profile-icon">
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" 
                    style="width:90px;height:90px;border-radius:50%;object-fit:cover;">
            @else
                {{-- グレー丸 --}}
                <div style="
                    width:90px;
                    height:90px;
                    border-radius:50%;
                    background:#ddd;">
                </div>
            @endif
        </div>

        <div class="profile-info">
            <p><span>ユーザー名：</span> {{ $user->name }}</p>
            <p><span>メール：</span> {{ $user->email }}</p>

            {{-- 追加フィールド（あれば表示） --}}
            @if($user->postal_code)
                <p><span>郵便番号：</span> {{ $user->postal_code }}</p>
            @endif

            @if($user->address)
                <p><span>住所：</span> {{ $user->address }}</p>
            @endif

            @if($user->phone)
                <p><span>電話番号：</span> {{ $user->phone }}</p>
            @endif

            <a href="{{ route('mypage.edit') }}" class="edit-btn">
                プロフィールを編集する
            </a>
        </div>

    </div>
</div>

@endsection