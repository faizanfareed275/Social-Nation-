<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

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
        // Share suggestedUsers globally
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $suggestedUsers = User::where('id', '!=', auth()->id())
                    ->inRandomOrder()
                    ->take(5)
                    ->get();
                $view->with('suggestedUsers', $suggestedUsers);
            } else {
                $view->with('suggestedUsers', collect()); // empty collection for guests
            }
        });
    }
}
