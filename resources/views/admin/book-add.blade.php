@extends('layouts.main')

@section('title', ' Add Books')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h1>Add Book</h1>
@if ($errors->any())
        <div class=" alert alert-danger w-50">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="/book-add" method="post" enctype="multipart/form-data">
    @csrf
    <label for="book_code" class="mb-2 mt-3 form-label">Book Code</label>
   <input type="book_code" name="book_code" id="book_code" class="w-50 form-control" placeholder="Book code">
   <label for="title" class="mb-2 mt-3 form-label">Title</label>
   <input type="title" name="title" id="title" class="w-50 form-control" placeholder="Title">
   <input type="file" name="image" id="image" class="mt-4 w-50 form-control">
   <label for="categories" class="mb-2 mt-3 form-label">Category</label>
   <select name="categories[]" id="categories" class="form-control w-50 select" multiple="multiple">
            @foreach($categories as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
   </select>
   <button type="submit" class=" btn btn-success">Save</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
        $('.select').select2();
        });
    </script>
@endsection