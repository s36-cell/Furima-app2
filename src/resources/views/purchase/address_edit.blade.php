@extends('layouts.app')

@section('content')
<div class="address-card">

    <h2>住所の変更</h2>

    <form action="{{ route('purchase.address.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>郵便番号</label>
            <input type="text" name="postal_code" value="{{ old('postal_code') }}">
        </div>

        <div class="form-group">
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>

        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building') }}">
        </div>

        <button class="submit-btn">更新する</button>
    </form>

</div>
@endsection