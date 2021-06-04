@section('title','Dashboard')
@extends('Admin.layout')
@section('content')
<div class="content-right">
    <h2>Dashboard</h2>
    <p>Welcome dashboard <span class="color-purple">{{auth()->user()->name}}!</span></p>
</div>
@endsection
