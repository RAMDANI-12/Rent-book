@extends('layouts.main')

@section('title', 'Users Banned')

@section('content')
<h1>List Users Banned</h1>
<div class="mt-4 d-flex justify-content-end">
    <a href="/users" class="btn btn-primary">List User</a>
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
            @foreach ($userBanned as $value)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$value->username}}</td>
                <td>{{$value->phone}}</td>
                <td>{{$value->address}}</td>
                <td>
                    <a href="/users-restore/{{$value->slug}}" class="btn btn-warning me-1"> Restore</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection