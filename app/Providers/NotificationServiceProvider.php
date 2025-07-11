<?php

namespace App\Providers;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Illuminate\Support\ServiceProvider;
use App\Notifications\Channels\PhpDesktopChannel;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        NotificationFacade::extend('phpdesktop', function ($app) {
            return new PhpDesktopChannel();
        });
    }
}
