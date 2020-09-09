<?php

namespace Jviatge\Satadmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Jviatge\Satadmin\console\NpmPackage;

class installCommand extends Command
{
    
    protected $signature = 'satadmin:install';

    protected $description = 'Install Satadmin :)';

    public function handle()
    {
        $this->info('Install Satadmin ==(°^°)');
        unlink(base_path('webpack.mix.js'));

        Artisan::call('vendor:publish', ['--provider' => 'Jviatge\Satadmin\SatadminServiceProvider']);
        $this->info(Artisan::output());
        
        Storage::disk('public')->makeDirectory('files/images');
        $this->info('Public files Directorie are created !');

        exec('php artisan ui bootstrap');
        // Artisan::call('ui bootstrap');
        // $this->info(Artisan::output());

        Artisan::call('storage:link');
        $this->info(Artisan::output());

        $this->info('npm install');
        exec('npm install');

        $this->info('npm install sass');
        exec('npm install sass');

        $this->info('npm run dev');
        exec('npm run dev');
        
        Artisan::call('config:clear');
        $this->info(Artisan::output());
       
        Artisan::call('cache:clear');
        $this->info(Artisan::output());
       
        Artisan::call('view:clear');
        $this->info(Artisan::output());
       
        Artisan::call('route:clear');
        $this->info(Artisan::output());
       
        Artisan::call('migrate');
        $this->info(Artisan::output());
    

    }

}
