@extends('layouts.app')

@section('content')
    <h1>Blog Posts</h1>

    <!-- Search bar -->
    <form method="GET" action="{{ route('blog-posts.index') }}">
        <input type="text" name="search" placeholder="Search blog posts by title..." value="{{ request()->query('search') }}">
        <button type="submit">Search</button>
    </form>

    <!-- Link to create a new blog post -->
    <a href="{{ route('blog-posts.create') }}">Create New Post</a>

    @if($posts->isEmpty())
        <p>No blog posts available.</p>
    @else
        @foreach($posts as $post)
            <div class="blog-post">
                <!-- Blog post title linked to the post's details page -->
                <h2>
                    <a href="{{ route('blog-posts.show', $post) }}">
                        {{ $post->title }}
                    </a>
                </h2>
                
                <!-- Display part of the blog body -->
                <p>{{ Str::limit($post->body, 100) }}</p>
                
                <!-- Display the author of the post -->
                <p>Posted by {{ $post->user->name }}</p>

                <!-- Buttons for editing and deleting (visible to the post owner or admin) -->
                @can('update', $post)
                    <a href="{{ route('blog-posts.edit', $post) }}">Edit</a>
                @endcan

                @can('delete', $post)
                    <form action="{{ route('blog-posts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endcan
            </div>
            <hr>
        @endforeach
    @endif
@endsection
