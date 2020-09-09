<?php

namespace Jviatge\Satadmin;

use Illuminate\Support\ServiceProvider;


class SatadminServiceProvider extends ServiceProvider{

    /**
     * @return void
     */
    public function boot()
    {
        $version = explode('.', app()->version())[0];

        if($version <= 8){
            $userURL   = '/tools/v8/User.php';
        } else {
            $userURL   = '/tools/vother/User.php';
        }

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'satadmin');
        $this->mergeConfigFrom(__DIR__.'/config/satadmin.php', 'satadmin');
        $this->publishes([
            __DIR__.'/config/satadmin.php'      => config_path('satadmin.php'),
            __DIR__.'/css/satadmin.css'         => public_path('css/satadmin.css'),
            __DIR__.'/js/fontawesome/all.js'    => public_path('js/fontawesome/all.js'),
            __DIR__. $userURL                   => app_path('Satadmin/User.php'),
            __DIR__.'/tools/unknown.png'        => public_path('storage/images/satadmin/unknown.png'),
            __DIR__.'/tools/webpack.mix.js'     => base_path('webpack.mix.js'),
        ]);
        
        app()->config["filesystems.disks.Satadmin"] = [
            'driver' => 'local',
            'root' => app_path('Satadmin'),
        ];
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
            Console\testCommand::class,
        ]);
        
    }
}