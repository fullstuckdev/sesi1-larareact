@extends('layouts.app-master')

@section('content')
<div class="container">
    <h1>Welcome to the Homepage!</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @include('products.index', ['products' => $products])
</div>
@endsection