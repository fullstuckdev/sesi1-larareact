<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .post-card {
            margin-bottom: 20px;
        }
        .post-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .owner-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            vertical-align: middle;
            margin-left: 5px;
        }
        .owner-name {
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Posts</h1>
        @foreach ($posts as $post)
            <div class="card post-card">
                <img src="{{ $post['image'] }}" class="card-img-top post-image" alt="Post Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $post['text'] }}</h5>
                    <p class="card-text">
                        <strong>Likes:</strong> {{ $post['likes'] }}<br>
                        <strong>Tags:</strong> {{ implode(', ', $post['tags']) }}<br>
                        <strong>Publish Date:</strong> {{ $post['publishDate'] }}<br>
                        <strong>Owner:</strong>
                        <span class="owner-name">{{ $post['owner']['firstName'] }} {{ $post['owner']['lastName'] }}</span>
                        <img src="{{ $post['owner']['picture'] }}" class="owner-avatar" alt="Owner Avatar">
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
