<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
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
        view()->composer('admin.layouts.header', function ($view) {
            $view->with([
                'adminName' => Auth::guard('admin')->user()->name,
            ]);
        });

        view()->composer('user.layouts.header', function ($view) {
            $view->with([
                'userName' => Auth::guard('user')->user()->name,
            ]);
        });

    }
}
