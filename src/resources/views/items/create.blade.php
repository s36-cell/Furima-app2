@extends('layouts.app')

@section('content')
<div class="sell-wrapper">

    <h2 class="sell-title">商品の出品</h2>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-block">
            <label class="form-label">商品画像</label>
            <div class="image-box">
                <input type="file" name="image">
            </div>
        </div>

        {{-- 商品の詳細 --}}
        <div class="form-block">
            <h3 class="section-title">商品の詳細</h3>

            {{-- カテゴリー（チップ） --}}
            <div class="category-area">
                <p class="form-label">カテゴリー</p>
                <div class="category-chips">
                    @foreach($categories as $category)
                        <label class="chip">
                            <input type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 商品の状態 --}}
        <div class="form-block">
            <label class="form-label">商品の状態</label>
            <select name="condition" class="select-box">
                <option value="">選択してください</option>
                <option value="新品・未使用"     {{ old('condition')=='新品・未使用' ? 'selected' : '' }}>新品・未使用</option>
                <option value="目立った傷や汚れなし" {{ old('condition')=='目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり" {{ old('condition')=='やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                <option value="状態が悪い"       {{ old('condition')=='状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
            </select>
        </div>

        {{-- 商品名と説明 --}}
        <div class="form-block">
            <label class="form-label">商品名</label>
            <input type="text" name="name" class="text-input"
                    value="{{ old('name') }}" placeholder="商品名を入力してください">
        </div>

        <div class="form-block">
            <label class="form-label">ブランド名</label>
            <input type="text" name="brand_name" class="text-input"
                    value="{{ old('brand_name') }}" placeholder="ブランド名を入力してください（任意）">
        </div>

        <div class="form-block">
            <label class="form-label">商品の説明</label>
            <textarea name="description" class="textarea"
                        placeholder="商品の状態や詳細を入力してください">{{ old('description') }}</textarea>
        </div>

        {{-- 価格 --}}
        <div class="form-block">
            <label class="form-label">販売価格</label>
            <div class="price-input-wrapper">
                <span class="yen-mark">￥</span>
                <input type="text" name="price" class="text-input price-input"
                        value="{{ old('price') }}" placeholder="0">
            </div>
        </div>

        {{-- 出品ボタン --}}
        <div class="form-block center">
            <button type="submit" class="sell-btn">出品する</button>
        </div>

    </form>
</div>
@endsection