<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Invitation;
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
    Gate::define('admin-access', function (User $user) {
        return $user->role === 'admin'; 
    });

View::composer('layouts.navigation', function ($view) {
            if (Auth::check()) {
                $invitations = Invitation::where('email', Auth::user()->email)
                    ->with(['sender', 'colocation'])
                    ->latest()
                    ->get();
                
                $view->with('receivedInvitations', $invitations);
            }
        });
     
}
}
