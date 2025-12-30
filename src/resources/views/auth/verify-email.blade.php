@extends('layouts.app')

@section('content')
<div style="max-width:600px; margin:50px auto; text-align:center;">

    <h2 style="margin-bottom:20px; font-weight:bold;">
        メールアドレスの確認が必要です
    </h2>

    <p style="margin-bottom:25px;">
        登録されたメールアドレス宛に認証メールを送信しました。<br>
        メール内のリンクをクリックして認証を完了してください。
    </p>

    {{--  メッセージ表示  --}}
    @if (session('status') === 'verification-link-sent')
        <p style="color:green; font-weight:bold;">
            認証メールを送信しました
        </p>
    @endif

    {{-- 再送ボタン --}}
    <form method="POST" action="{{ route('verification.send') }}" style="margin-top:20px;">
        @csrf
        <button style="
            padding:10px 20px;
            background:#ff4f4f;
            border:none;
            color:white;
            border-radius:6px;
            font-size:14px;
            cursor:pointer;">
            認証メールを再送する
        </button>
    </form>

    {{-- ログアウト --}}
    <form method="POST" action="{{ route('logout') }}" style="margin-top:25px;">
        @csrf
        <button style="
            padding:8px 16px;
            background:#444;
            border:none;
            color:white;
            border-radius:5px;
            font-size:13px;
            cursor:pointer;">
            ログアウト
        </button>
    </form>

</div>
@endsection