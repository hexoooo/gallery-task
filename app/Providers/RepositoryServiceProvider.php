<?php

namespace App\Providers;

use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\GalleryRepository;
use App\Repository\RepositoryInterface;
use App\Repository\GalleryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(GalleryRepositoryInterface::class, GalleryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
