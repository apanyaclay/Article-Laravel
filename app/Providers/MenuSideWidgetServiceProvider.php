<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuSideWidgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.side-widget', function ($view) {
            $categories = Categorie::withCount(['Articles' => function(Builder $query) {
                $query->whereStatus('published');
            }])->get();
            $view->with('categories', $categories);
        });
        View::composer('layouts.side-widget', function ($view) {
            $populars = Article::orderByDesc('views')->take(5)->get();
            $view->with('populars', $populars);
        });
    }
}
