<?php

namespace App\Http\ViewComposers;

use App\User;
use App\BlogPost;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer
{
  public function compose(View $view)
  {
    $mostCommented = Cache::tags(['blog-post'])->remember('mostCommented', 300, function () {
      return BlogPost::mostCommented()->take(5)->get();
    });
    $mostActive = Cache::remember('mostActive', 300, function () {
        return User::withMostBlogPosts()->take(5)->get();
    });
    $mostActiveLastMonth = Cache::remember('mostActiveLastMonth', 300, function () {
        return User::withMostBlogPostsLastMonth()->take(5)->get();
    });

    $view->with('mostCommented', $mostCommented);
    $view->with('mostActive', $mostActive);
    $view->with('mostActiveLastMonth', $mostActiveLastMonth);
  }
}