@extends('layouts.app')

@section('content')
    <h1>{{ $blogPost->title }}</h1>
    <p>{{ $blogPost->body }}</p>
    <p>Posted by {{ $blogPost->user->name }}</p>

    <h2>Comments</h2>
    <div id="comments">
        <!-- Display comments here -->
        @foreach($blogPost->comments as $comment)
            <div>
                <p>{{ $comment->body }} - Posted by {{ $comment->user->name }}</p>
            </div>
        @endforeach
    </div>

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="blog_post_id" value="{{ $blogPost->id }}">
        <div>
            <label for="body">Comment</label>
            <textarea name="body" id="body" required></textarea>
        </div>
        <button type="submit">Add Comment</button>
    </form>
@endsection
