@extends('layouts.app')

@section('content')
<div class="form-wrapper">
    <h2>商品を出品する</h2>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>商品名</label>
        <input type="text" name="name">

        <label>価格</label>
        <input type="number" name="price">

        <label>商品画像</label>
        <input type="file" name="image">

        <button class="btn">出品する</button>
    </form>
</div>
@endsection