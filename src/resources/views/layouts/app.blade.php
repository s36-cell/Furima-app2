<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECHフリマ</title>
    @vite(['resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body>

<header class="header">
    <div class="header-inner">
        <div class="header-left">
            <a href="/" class="logo">
                <img src="{{ asset('images/logo1.png') }}" alt="COACTECHフリマロゴ" class="logo-img">
            </a>
        </div>

        @auth
        <div class="header-center">
            <form action="{{ route('items.index') }}" method="GET" class="search-form">
                <input type="text" name="keyword" class="search-box" placeholder="商品名を検索" value="{{ request('keyword') }}">
                <button type="submit" class="search-btn">検索</button>
            </form>
        </div>
        @endauth
        <div class="header-right">

            @auth
                <a href="{{ route('logout')}}" class="header-link header-btn-black"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <a href="{{ route('items.create') }}"
                    class="header-link header-btn-white">出品</a>
                <a href="{{ route('mypage.index') }}" class="header-link header-btn-black">マイページ</a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            @endauth
        </div>

    </div>
</header>

<main class="main">
    @yield('content')
</main>

</body>
</html>