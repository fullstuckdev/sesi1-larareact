@extends('layouts.app-master')

@section('content')
<div class="container">
    <h1>List Users</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @include('users.show', ['users' => $users])
</div>
@endsection