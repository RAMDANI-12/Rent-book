@extends('layouts.main')

@section('title', 'Profile')

@section('content')


<h1>Welcome {{Auth::user()->username}} </h1>


@endsection