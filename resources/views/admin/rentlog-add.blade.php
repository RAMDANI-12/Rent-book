@extends('layouts.main')

@section('title','Add Rent Book')

@section('content')

<div class="text-center">
    <h3>Add RentBook</h3>
</div>

<div class="col-12 col-md-8 offset-md-2 col-md-4 offset-md-4">
    <div class="mt-4">
        @if (session('message'))
            <div class="alert alert-danger w-50">
                {{session('message')}}
            </div>
        @endif
    </div>
<form action="/rentlog-add" method="post">
    @csrf
    <div class="mb-3">
        <label for="user_id" class="label form-label">user</label>
        <select name="user_id" id="user_id" class="form-control w-50">
            <option value="">Select Users</option>
            @foreach ($user as $item)
                <option value="{{$item->id}}">{{$item->username}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="book_id" class="label form-label">book</label>
        <select name="book_id" id="book_id" class="form-control w-50">
            <option value="">Select Book</option>
            @foreach ($books as $book )
                <option value="{{$book->id}}">{{$book->title}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary w-50 mt-3">Submit</button>
</form>
</div>

@endsection