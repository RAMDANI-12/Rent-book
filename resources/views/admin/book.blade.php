@extends('layouts.main')

@section('title', 'Books')

@section('content')
<h1>Ini halaman Books</h1>
<div class="my-4 d-flex justify-content-end">
    <a href="/book-add" class="btn btn-info">Add Category</a>
</div>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
<div class="mt-5">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Code</th>
                <th>Title</th>
                <th>Cover</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>  
            @foreach($book as $value) 
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$value->book_code}}</td>
                <td>{{$value->title}}</td>
                <td>
                    @if ($value->cover !='')
                    <img src="{{asset('storage/cover/'.$value->cover)}}" alt="" width="75px" height="75px">
                    @else
                    <img src="{{asset('assets/img/404.png')}}" alt="" width="75px" height="75px">
                    @endif
                </td>
                <td>
                    @foreach ($value->categories as $category )
                        {{$category->name}},
                    @endforeach
                </td>
                <td>{{$value->status}}</td>
                <td>
                    <a href="/books-edit/{{$value->slug}}" class= "btn btn-primary"> Edit</a>
                    <a href="/books-delete/{{$value->slug}}" class= "btn btn-danger"> Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection