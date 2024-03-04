@extends('layouts.app-master')

@section('content')
<div class="container">
    <h1>List Products</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @include('products.show', ['products' => $products])
</div>
@endsection