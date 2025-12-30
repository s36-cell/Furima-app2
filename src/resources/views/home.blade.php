@extends('layouts.app')



@section('content')

<div style="text-align:center; margin-top:40px;">

    <h2>ログイン成功</h2>

    <p>COACHTECHフリマへようこそ</p>



    <form method="POST" action="{{ route('logout') }}">

        @csrf

        <button type="submit">ログアウト</button>

    </form>

</div>

@endsection