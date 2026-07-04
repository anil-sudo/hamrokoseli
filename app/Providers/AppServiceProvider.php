<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
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
        if (! app()->isLocal()) {
            \URL::forceScheme('https');
        }
        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            $routeName = $notifiable->isVendor() ? 'seller.password.reset' : 'password.reset';

            return url(route($routeName, [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        });

        // Dynamically resolve public disk URL based on the request to avoid broken/hanging previews in Filament
        if (! app()->runningInConsole()) {
            config(['filesystems.disks.public.url' => asset('storage')]);
        }
    }
}
