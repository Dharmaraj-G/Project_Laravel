@extends('layouts.app')

@section('content')
    <h1>Edit Blog Post</h1>

    <form action="{{ route('blog-posts.update', $blogPost) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $blogPost->title }}" required>
        </div>
        <div>
            <label for="body">Body</label>
            <textarea name="body" id="body" required>{{ $blogPost->body }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
