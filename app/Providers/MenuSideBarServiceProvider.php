<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuSideBarServiceProvider extends ServiceProvider
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
        View::composer('layouts.sidebar', function ($view) {
            $menus = Menu::with('submenus')->orderBy('order_no')->get();
            $view->with('menus', $menus);
        });
    }
}
