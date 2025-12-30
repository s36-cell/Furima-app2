@extends('layouts.app')

@section('content')

<div class="auth-wrapper">
    <div class="auth-card">

        <h2 class="auth-title">ログイン</h2>

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



        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="auth-group">
                <label>パスワード</label>
                <input type="password" name="password">
            </div>

            <button class="auth-btn">
                ログイン
            </button>

            <p class="auth-link">
                会員登録は <a href="{{ route('register') }}">こちら</a>
            </p>

        </form>

    </div>
</div>

@endsection