<?php

namespace App\Providers;

use App\Models\Catergory;
use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.front', function ($view) {
            $view->with('categories', Catergory::all());
        });
    }
}
