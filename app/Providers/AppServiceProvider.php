<?php

namespace App\Providers;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.sidebar', function ($view) {
            $menus = Menu::with('submenus')->orderBy('order_no')->get();
            $view->with('menus', $menus);
        });
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
