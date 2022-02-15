<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /**
         * a user can only edit their posts or profile
         * if the user, is an administrator = true
        */
        Gate::define('edit-post', function (User $user, Post $post) {
            if( $user->rank === "Administrator"){
                return true;
            }
            return $user->id === $post->user_id;
        });


        /**
         * if the user, is the current user = true
         * if the user, is an administrator = true
        */
        Gate::define('is-user', function ( $logged_in_user, $user) {
            if( $user->rank === "Administrator"){
                return true;
            }

            return $logged_in_user->id === $user->id;
        });
    }
}
