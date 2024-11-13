<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理者ダッシュボード</h1>
    <p>ようこそ、管理者 {{ Auth::user()->name }} さん！</p>
</div>
@endsection
