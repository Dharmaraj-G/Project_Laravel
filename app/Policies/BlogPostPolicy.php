<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;

class BlogPostPolicy
{
    /**
     * Determine if the given blog post can be updated by the user.
     */
    public function update(User $user, BlogPost $post)
    {
        // Allow update if the user is the post owner or the user is an admin
        return $user->id === $post->user_id || $user->is_admin;
    }

    /**
     * Determine if the given blog post can be deleted by the user.
     */
    public function delete(User $user, BlogPost $post)
    {
        // Allow delete if the user is the post owner or the user is an admin
        return $user->id === $post->user_id || $user->is_admin;
    }
}
