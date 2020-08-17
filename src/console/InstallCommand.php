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

        // 1) add service provider 

        // 2) php artisan vendor:publish --provider="Jviatge\Satadmin\SatadminServiceProvider"

        $homepage = file_get_contents(config_path('app.php'));
        echo $homepage;


        dd();
        


        Storage::disk('public')->makeDirectory('files/images');
        $this->info('Public files Directorie are created !');

        Artisan::call('storage:link');
        $this->info(Artisan::output());
        
        //install dir Satadmin
        mkdir(app_path('Satadmin'), 0700);
        $this->info(app_path('Satadmin'));

        //install support user
        $Content = $this->user();
        $file = app_path('Satadmin/Users.php');
        file_put_contents($file, $Content, FILE_APPEND | LOCK_EX);
        $this->info('Users.php are created !');
       

    }
















    function user(){
        return "<?php 

namespace App\Satadmin;

use Jviatge\Satadmin\Table;
use Illuminate\Support\Facades\DB;
use Jviatge\Satadmin\\fields\Id;
use Jviatge\Satadmin\\fields\Email;
use Jviatge\Satadmin\\fields\Text;
use Jviatge\Satadmin\\fields\Password;

class Users //extends Table
{
    public static function label() 
    {
        return 'Users';
    }

    public static function support() 
    {
        return 'users';
    }

    public static function table() 
    {
        return  \App\User::class;
    }

    public static function fields() 
    {    
        return  [

            Id::create(),
            Text::create('Nom', 'name'),
            Email::create('Email', 'email'),
            Password::create('Password', 'password'),
            
        ];
    }

}";

    }

   
}
