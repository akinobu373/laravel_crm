@extends('layouts.main')

@section('title', '顧客詳細画面')

@section('content')
<h1>顧客詳細画面</h1>
<table>
    <tr>
        <th>顧客ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>郵便番号</th>
        <th>住所</th>
        <th>電話番号</th>
    </tr>
    <tr>
        <td>{{ $crm->id }}</td>
        <td>{{ $crm->name }}</td>
        <td>{{ $crm->email }}</td>
        <td>{{ $crm->zipcode }}</td>
        <td>{{ $crm->address }}</td>
        <td>{{ $crm->phone_number }}</td>
    </tr>
</table>
<div class="button-group">
    <button onclick="location.href='{{ route('crms.edit',$crm) }}'">編集画面</button>
    <form action="/crms/{{ $crm->id }}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="削除する" onclick="if(!confirm('削除しますか？')){return false};">
    </form>
    <button onclick="location.href='{{ route('crms.index') }}'">一覧に戻る</button>
</div>
@endsection
