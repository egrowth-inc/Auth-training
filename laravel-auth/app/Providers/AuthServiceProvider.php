<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post; 
use App\Policies\UserPolicy; 


class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-settings', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('publish-post', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->isAdmin();
        });
    }
}
