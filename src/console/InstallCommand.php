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
        
        //install dir Satadmin
        // try
        // {
        //     mkdir(app_path('Satadmin'), 0700);
        //     $this->info(app_path('Satadmin'));
    
        //     //install support user
        //     $Content = $this->user();
        //     $file = app_path('Satadmin/Users.php');
        //     file_put_contents($file, $Content, FILE_APPEND | LOCK_EX);
        //     $this->info('Users.php are created !');

        // } 
        // catch (\Throwable $th)
        // {
        //     $this->info($th->getMessage());
        // }
       

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





    function user(){
        return "<?php 

namespace App\Satadmin;

use Jviatge\Satadmin\\fields\Email;
use Jviatge\Satadmin\\fields\Text;
use Jviatge\Satadmin\\fields\Password;
use Jviatge\Satadmin\Support as Support;

class Users extends Support
{
    public static function label() 
    {
        return 'Users';
    }

    public static function table() 
    {
        return  \App\User::class;
    }

    public static function fields() 
    {    
        return  [

            Text::create('Nom', 'name'),
            Email::create('Email', 'email'),
            Password::create('Password', 'password'),
            
        ];
    }

}";

    }

   
}
