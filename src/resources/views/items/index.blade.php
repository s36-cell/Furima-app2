@extends('layouts.app')

@section('content')
<h2 class="page-title">商品一覧</h2>

<div class="items-tabs">
    <button class="tab-btn active" data-target="recommend">おすすめ</button>
    <button class="tab-btn" data-target="mylist">マイリスト</button>
</div>

{{-- おすすめ --}}
<div id="recommend" class="tab-content active">
    @include('items.list', ['items'=>$items])
</div>

{{-- マイリスト --}}
<div id="mylist" class="tab-content">
    @include('items.list', ['items'=>$items->whereIn('id',$likes)])
</div>

{{-- タブ切替JS --}}
<script>
const tabs = document.querySelectorAll('.tab-btn');
const contents = document.querySelectorAll('.tab-content');

tabs.forEach(btn => {
    btn.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        contents.forEach(c => c.classList.remove('active'));
        document.getElementById(btn.dataset.target).classList.add('active');
    });
});
</script>

@endsection