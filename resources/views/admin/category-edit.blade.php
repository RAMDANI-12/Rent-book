@extends('layouts.main')

@section('title', 'Edit Category')

@section('content')
<h1>Update Category</h1>
    @if ($errors->any())
        <div class=" alert alert-danger w-50">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="/category-edit/{{$category->slug}}" method="post">
    @csrf
    @method('put')
   <label for="name" class="mb-4 form-label">Category Name</label>
   <input type="name" name="name" id="name" class="w-50 form-control" value="{{$category->name}}">
   <button type="submit" class="mt-3 btn btn-success">Save</button>
</form>
@endsection