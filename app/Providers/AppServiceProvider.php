<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Scopes\PostScope;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       paginator::usebootStrap();

       //share number of requests to an admin nav bar
       $request = Post::withoutGlobalScope(PostScope::class)->where('status','0')->count();
       View::share('request', $request);
    }
}
