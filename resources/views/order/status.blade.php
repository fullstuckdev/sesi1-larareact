@extends('layouts.app-master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Order History</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Address</th>
                    <th scope="col">Total Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Product</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->total_order }}</td>
                        <td>
                            @if ($order->status == 0)
                                <span class="badge badge-secondary">Pending</span>
                            @elseif ($order->status == 1)
                                <span class="badge badge-warning">On Process</span>
                            @elseif ($order->status == 2)
                                <span class="badge badge-success">Done</span>
                            @elseif ($order->status == 3)
                                <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $order->product->name }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
