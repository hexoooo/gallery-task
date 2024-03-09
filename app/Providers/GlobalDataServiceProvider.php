<?php

namespace App\Providers;

use App\Models\Gallery;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    public function boot(): void
    {
        view()->share('galleries', Gallery::all());

    }
}
