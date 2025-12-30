@extends('layouts.app')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">会員登録</h2>

        {{-- エラー --}}
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="auth-group">
                <label>ユーザー名</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div class="auth-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="auth-group">
                <label>パスワード</label>
                <input type="password" name="password">
            </div>

            <div class="auth-group">
                <label>確認用パスワード</label>
                <input type="password" name="password_confirmation">
            </div>

            <button class="auth-btn">登録</button>

            <p class="auth-link">
                ログインは <a href="{{ route('login') }}">こちら</a>
            </p>

        </form>

    </div>

</div>

@endsection