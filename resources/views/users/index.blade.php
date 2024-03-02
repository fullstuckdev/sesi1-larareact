<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Users</h1>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4 user-card">
                    <div class="card">
                        <img src="{{ $user['picture'] }}" class="card-img-top user-image" alt="{{ $user['firstName'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user['firstName'] }} {{ $user['lastName'] }}</h5>
                            <p class="card-text">Title: {{ $user['title'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ url('/posts') }}" class="btn btn-primary mt-3">View Posts</a>
    </div>
</body>
</html>
