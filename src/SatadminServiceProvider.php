<?php

namespace Jviatge\Satadmin;

use Illuminate\Support\ServiceProvider;


class SatadminServiceProvider extends ServiceProvider{

    /**
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'satadmin');
        $this->mergeConfigFrom(__DIR__.'/config/satadmin.php', 'satadmin');
        $this->publishes([
            __DIR__.'/config/satadmin.php' => config_path('satadmin.php'),
            // __DIR__.'/../resources/views' => resource_path('views/vendor/blogpackage'),
        ]);
    }
    
    /**
     * @return void
     */
    public function register()
    {
        $this->commands([
            Console\installCommand::class,
            Console\supportCommand::class,
            Console\userCommand::class,
        ]);
        
    }

    // ->CONFIG INSTALL
    // php artisan vendor:publish --provider="Jviatge\Satadmin\SatadminServiceProvider"
    // php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan route:clear

    // https://www.youtube.com/watch?v=sfR2kuxnuWU&list=PLpzy7FIRqpGBQ_aqz_hXDBch1aAA-lmgu&index=16
}