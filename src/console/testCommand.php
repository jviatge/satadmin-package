<?php

namespace Jviatge\Satadmin\Console;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class testCommand extends Command
{
    
    protected $signature = 'satadmin:test';

    protected $description = 'Testing jusqua le mise a mort';

    public function handle()
    {
        // $old = 7.0.2;
        // $version = explode('.', app()->version())[0];
        // $this->info($version);
        // Artisan::call('ui bootstrap');
        $this->info(base_path());

        // $name = $this->ask('Name');

        // $email = $this->ask('Email');

        // $password = $this->secret('Password');

        // $hash = Hash::make($password);

        // $myModel =  \App\User::class;
        // $myModel::create([
        //     'name' => $name,
        //     'email' => $email,
        //     'password' => $hash
        // ]);

        
        // app_path()
        // base_path()

        // $this->info('Finish !');

    }
}
