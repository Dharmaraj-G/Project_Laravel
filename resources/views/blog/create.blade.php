@extends('layouts.app')

@section('content')
    <h1>Create Blog Post</h1>

    <form action="{{ route('blog-posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="body">Body</label>
            <textarea name="body" id="body" required></textarea>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
