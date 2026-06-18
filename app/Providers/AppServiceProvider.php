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
            $user = auth()->user();
            if ($user && $user->role_id) {
                $roleId = $user->role_id;
                $sidebarMenus = \App\Models\Menu::whereNull('parent_id')
                    ->where('is_active', 1)
                    ->whereHas('roles', function ($query) use ($roleId) {
                        $query->where('roles.id', $roleId);
                    })
                    ->with(['submenus' => function ($query) use ($roleId) {
                        $query->where('is_active', 1)
                            ->whereHas('roles', function ($q) use ($roleId) {
                                $q->where('roles.id', $roleId);
                            })
                            ->orderBy('order');
                    }])
                    ->orderBy('order')
                    ->get();
            } else {
                $sidebarMenus = collect();
            }
            $view->with('sidebarMenus', $sidebarMenus);
        });
    }
}
