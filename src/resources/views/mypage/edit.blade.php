@extends('layouts.app')

@section('content')

<div class="profile-edit-wrapper">

    <h2 class="edit-title">プロフィール編集</h2>

    <div class="profile-edit-card">

        <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- プロフィール画像 --}}
            <label>プロフィール画像</label>
            <input type="file" name="profile_image">
            {{-- ユーザー名 --}}
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">

            {{-- メール --}}
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">

            {{-- 郵便番号 --}}
            <label>郵便番号</label>
            <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">

            {{-- 住所 --}}
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}">

            {{-- 電話番号 --}}
            <label>電話番号</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">

            <button class="save-btn">
                プロフィールを更新する
            </button>

        </form>

    </div>

</div>

@endsection