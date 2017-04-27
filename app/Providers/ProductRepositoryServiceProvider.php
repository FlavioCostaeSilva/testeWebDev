<?php

namespace App\Providers;

use App\Models\Entities\Product;
use App\Models\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductRepositoryServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ProductRepositoryInterface',
            'App\\Models\\Repositories\\ProductRepository');
    }

    public function provides()
    {
        return ['ProductRepositoryInterface'];
    }
}
