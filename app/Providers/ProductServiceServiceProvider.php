<?php

namespace App\Providers;

use App\Models\Services\ProductService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ProductServiceServiceProvider extends ServiceProvider
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
        $this->app->bind('ProductServiceInterface', function($app) {
            return new ProductService(
                App::make('ProductRepositoryInterface')
            );
        });
    }

    public function provides()
    {
        return ['ProductServiceInterface'];
    }
}
