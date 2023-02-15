@extends('layouts.main')

@section('title', 'Users')

@section('content')
<h1>List User</h1>
<div class="mt-4 d-flex justify-content-end">
    <a href="/users-benned" class="btn btn-secondary me-3">View ban user</a>
    <a href="/users-registered" class="btn btn-primary">Vie New Registered User</a>
</div>
<div class="mt-4">
    @if(session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <td>No</td>
                <td>Username</td>
                <td>Phone</td>
                <td>Adress</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $value)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$value->username}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->address}}</td>
                <td>
                    <a href="/user-detail/{{$value->slug}}" class="btn btn-warning me-1"> Detail</a>
                    <a href="/users-ban/{{$value->slug}}" class="btn btn-danger me-1"> Ban User</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection