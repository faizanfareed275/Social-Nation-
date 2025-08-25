<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // This will be executed before rendering any view
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $suggestedUsers = User::where('id', '!=', auth()->id())
                                    ->inRandomOrder()
                                    ->take(5)
                                    ->get();
            } else {
                $suggestedUsers = collect(); // Empty collection if not logged in
            }

            $view->with('suggestedUsers', $suggestedUsers);
        });
    }

    public function register()
    {
        //
    }
}
