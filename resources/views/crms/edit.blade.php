@extends('layouts.main')

@section('title', '編集画面')

@section('content')
<h1>編集画面</h1>
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
<form action={{ route('crms.update', $crm) }} method="post">
    @csrf
    @method('patch')
    <div>
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $crm->name) }}">
    </div>
    <div>
        <label for="email">メールアドレス:</label>
        <input type="text" name="email" id="email" value="{{ old('email', $crm->email) }}">

    </div>
    <div>
        <label for="zipcode">郵便番号:</label>
        <input type="text" name="zipcode" id="zipcode" value="{{ old('email', $crm->zipcode) }}">
    </div>
    <div>
        <label for="address">住所:</label>
        <textarea type="text" name="address">{{ old('address', $crm->address) }}</textarea>
    </div>
    <div>
        <label for="phone_number">電話番号:</label>
        <input type="text" name="phone_number" id="phone_number" value="{{old('phone_number', $crm->phone_number)}}">
    </div>

    <div>
        <input type="submit" value="更新">
    </div>
    <div>
        <button onclick="location.href='{{ route('crms.index') }}'">戻る</button>
    </div>

</form>
@endsection
