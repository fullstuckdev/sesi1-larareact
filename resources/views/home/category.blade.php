@extends('layouts.app-master')

@section('content')
<div class="container">
    <h1>List Category</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @include('category.index', ['categories' => $categories])
</div>
@endsection