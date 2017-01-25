<?php

namespace Asanzred\Gopaytoo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class GopaytooServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // modify this if you want disable tutorial routes
        $this->setupRoutes($this->app->router);
        
        
        //php artisan vendor:publish --provider="Asanzred\Gopaytoo\GopaytooServiceProvider"
        $this->publishes([
                __DIR__.'/config/gopaytoo.php' => config_path('gopaytoo.php'),
        ]);
        
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/gopaytoo.php', 'gopaytoo'
        );
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Asanzred\Gopaytoo\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerIdeal();
        
        //use this if your package has a config file
        config([
                'config/gopaytoo.php',
        ]);
    }

    private function registerIdeal()
    {
        $this->app->bind('gopaytoo',function($app){
            return new Gopaytoo($app);
        });
    }
}