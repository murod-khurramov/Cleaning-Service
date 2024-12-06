<div>
    <h1>Dear {{ $post->user->name }}!</h1>
    <h5>You created a new post at {{ $post->created_at }}</h5>
    <p>Post ID: {{ $post->id }}</p>
    <div>{{ $post->title }}</div>
    <div>{{ $post->short_content }}</div>
    <div>{{ $post->content  }}</div>
    <storng>Thank you! </storng>
</div>
