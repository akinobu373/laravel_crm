@extends('layouts.main')

@section('title', '新規登録画面')

@section('content')
<h1>新規登録画面</h1>
@if ($errors->any())
<div class="error">
    <p>
        <b>{{ count($errors) }}件のエラーがあります。</b>
    </p>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('crms.store') }}" method="POST">
    @csrf
    <label for="name">名前</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}">
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email" value="{{ old('email') }}">
    <label for="zipcode">郵便番号</label>
    <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode',$zipcode) }}">
    <label for="address">住所</label>
    <textarea type="text" name="address">{{ old('address',$address) }}</textarea>
    <label for="phone_number">電話番号</label>
    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
    <input type="submit" value="登録">
</form>
<button onclick="location.href='{{ route('crms.search') }}'">郵便番号検索に戻る</button>
@endsection
