@extends('Admin.layout')
@section('currentPage','Profile')
@section('content')
<div class="content-right user-profile">
    <h2>Profile</h2>
    <div class="content">
        <div class="flex-item">
            <span>Name</span>
            <p>{{auth()->user()->name}}</p>
        </div>
        <div class="flex-item">
            <span>Email</span>
            <p>{{auth()->user()->email}}</p>
        </div>
        <div class="flex-item">
            <span>products created</span>
            <p>{{auth()->user()->products->count()}}</p>
        </div>
    </div>
</div>
@endsection
