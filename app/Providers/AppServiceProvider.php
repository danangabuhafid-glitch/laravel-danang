<?php

namespace App\Providers;

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
        view()->composer('Master.layouts.sidebar', function ($view) {
            $sidebarMenus = \App\Models\Menu::with('submenus')
                ->whereNull('parent_id')
                ->where('is_active', 1)
                ->orderBy('order')
                ->get();
            $view->with('sidebarMenus', $sidebarMenus);
        });
    }
}
