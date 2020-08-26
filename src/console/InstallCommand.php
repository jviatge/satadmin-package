<?php

namespace Jviatge\Satadmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class installCommand extends Command
{
    
    protected $signature = 'satadmin:install';

    protected $description = 'Install Satadmin :)';

    public function handle()
    {
        $this->info('Install Satadmin ==(°^°)');

        Artisan::call('vendor:publish', ['--provider' => 'Jviatge\Satadmin\SatadminServiceProvider']);
        $this->info(Artisan::output());
        
        Storage::disk('public')->makeDirectory('files/images');
        $this->info('Public files Directorie are created !');

        Artisan::call('ui bootstrap');
        $this->info(Artisan::output());

        Artisan::call('storage:link');
        $this->info(Artisan::output());
        
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
