@extends('layouts.main')

@section('title', 'User detail')

@section('content')
<h1>User Detail</h1>
<div class="mt-4 d-flex justify-content-end">
    @if ($user->status == 'inactive')
        <a href="/user-approve/{{$user->slug}}" class="btn btn-primary mt-3 me-2">Approve User</a>
        <a href="/users-registered" class="btn btn-secondary mt-3">Back</a>
    @else
    <a href="/users" class="btn btn-secondary mt-3">Back</a>
    @endif
</div>

<div class="mt-4">
@if(session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif
    <div class="mt-3">
        <label for="" class="form-laebl">Username</label>
        <input type="text" class="form-control" readonly value="{{$user->username}}"> 
    </div>
    <div class="mb-3">
        <label for="" class="form-laebl">Phone</label>
        <input type="text" class="form-control" readonly value="{{$user->phone}}"> 
    </div>
    <div class="mb-3">
        <label for="" class="form-laebl">Adress</label>
        <input type="text" class="form-control" readonly value="{{$user->address}}"> 
    </div>
    <div class="mb-3">
        <label for="" class="form-laebl">Status</label>
        <input type="text" class="form-control" readonly value="{{$user->status}}"> 
    </div>
</div>
@endsection