<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BlogPostController extends Controller
{
    use AuthorizesRequests; // Enable authorization

    // Display all blog posts to all users
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');

    if ($search) {
        // If a search query exists, get blog posts with titles matching the query
        $posts = BlogPost::where('title', 'like', '%' . $search . '%')->get();
    } else {
        // Otherwise, get all blog posts
        $posts = BlogPost::all();
    }

    // Pass the search query and posts to the view
    return view('blog.index', compact('posts', 'search'));
}


    // Show a single blog post
    public function show(BlogPost $blogPost)
    {
        return view('blog.show', compact('blogPost')); // Show the selected blog post
    }

    // Show the form for creating a new blog post
    public function create()
    {
        return view('blog.create'); // Return the view for creating a new blog post
    }

    // Store a newly created blog post in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $blogPost = new BlogPost();
        $blogPost->title = $validated['title'];
        $blogPost->body = $validated['body'];
        $blogPost->user_id = Auth::id(); // Assign the post to the current authenticated user
        $blogPost->save();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    // Show the form for editing a specific blog post
    public function edit(BlogPost $blogPost)
    {
        // Check if the current user is authorized to edit the post
        $this->authorize('update', $blogPost);

        return view('blog.edit', compact('blogPost'));
    }

    // Update a specific blog post in the database
    public function update(Request $request, BlogPost $blogPost)
    {
        // Check if the current user is authorized to update the post
        $this->authorize('update', $blogPost);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $blogPost->update($validated);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    // Delete a specific blog post from the database
    public function destroy(BlogPost $blogPost)
    {
        // Check if the current user is authorized to delete the post
        $this->authorize('delete', $blogPost);

        $blogPost->delete();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
