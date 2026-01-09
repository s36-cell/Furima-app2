@extends('layouts.app')

@section('content')
<h1>マイリスト</h1>

@if($likeItems->isEmpty())
    <p>マイリストに商品はありません。</p>
@else
    <ul>
        @foreach($likeItems as $item)
            <li>
                <a href="{{ route('items.show', $item->id) }}">
                    {{ $item->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
@endsection