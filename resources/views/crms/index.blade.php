@extends('layouts.main')

@section('title', '顧客一覧')

@section('content')
<h1>顧客一覧</h1>

<table>
    <tr>
        <th>顧客ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>郵便番号</th>
        <th>住所</th>
        <th>電話番号</th>
    </tr>
    @foreach ($crms as $crm)
    <tr>
        <td><a href="{{ route('crms.show', $crm) }}">{{ $crm->id }}</a></td>
        <td>{{ $crm->name }}</td>
        <td>{{ $crm->email }}</td>
        <td>{{ $crm->zipcode }}</td>
        <td>{{ $crm->address }}</td>
        <td>{{ $crm->phone_number }}</td>
    </tr>
    @endforeach
</table>
<button onclick="location.href='{{ route('crms.search') }}'">新規登録</button>

@endsection
