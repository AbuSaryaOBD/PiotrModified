<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home1.secret', function ($user){
            return $user->is_admin;
        });



        // Gate::define('update_post', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('delete_post', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });



        // Gate::define('posts.update', 'App\policies\BlogPostPolicy@update');
        // Gate::define('posts.delete', 'App\policies\BlogPostPolicy@delete');

        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');



        Gate::before(function($user, $ability){
            if ($user->is_admin && in_array($ability, ['update', 'delete'])){
                return true;
            }
        });
    }
}
