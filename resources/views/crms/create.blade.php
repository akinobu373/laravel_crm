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
    <p>名前</p>
    <input type="text" name="name" id="name" value="{{ old('name') }}">
    <p>メールアドレス</p>
    <input type="text" name="email" id="email" value="{{ old('email') }}">
    <p>郵便番号</p>
    <input type="text" name="zipcode" id="zipcode" value="{{ old('zipcode',$zipcode) }}">
    <p>住所</p>
    <textarea type="text" name="address">{{ old('address',$address) }}</textarea>
    <p>電話番号</p>
    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
    <p><input type="submit" value="登録"></p>
</form>
<button onclick="location.href='{{ route('crms.search') }}'">郵便番号検索に戻る</button>
@endsection
