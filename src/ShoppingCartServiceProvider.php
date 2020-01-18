<?php

namespace NguyenBo\ShoppingCart;

use Illuminate\Support\ServiceProvider;
use NguyenBo\ShoppingCart\Services\ShoppingCart;
use NguyenBo\ShoppingCart\Services\Session;
use NguyenBo\ShoppingCart\Services\Database;

class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->getStorageService() == 'session') {
            $this->app->singleton('shoppingcart', function($app) {
                return new Session($app['session'], $app['events']);
            });
        } else {
            $this->app->singleton('shoppingcart', function($app) {
                return new Database();
            });
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/shoppingcart.php' => config_path('shoppingcart.php'),
        ], 'config');
    }

    /**
     * Get the storage settings based on config file
     *
     * @return string
     */
    public function getStorageService()
    {
        $class = $this->app['config']->get('shoppingcart.storage', 'session');

        switch ($class)
        {
            case 'session':
                return 'session';
            break;
            case 'database':
                return 'database';
            break;
            default:
                return 'session';
            break;
        }
    }
}
