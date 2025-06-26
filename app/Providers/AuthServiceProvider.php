<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Define your policies here if needed
        // 'App\Models\Post' => 'App\Policies\PostPolicy',
        // 'App\Models\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Allow admins to edit any post, but regular users can only edit their own posts
        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->hasRole('Admin') || $user->id === $post->user_id;
        });

        // Allow admins to edit any comment, but regular users can only edit their own comments
        Gate::define('edit-comment', function (User $user, Comment $comment) {
            return $user->hasRole('Admin') || $user->id === $comment->user_id;
        });

        // You can add more gates for other actions like delete, view, etc.
    }
}
