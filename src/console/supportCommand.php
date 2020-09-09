<?php

namespace Jviatge\Satadmin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class supportCommand extends Command
{
    
    protected $signature = 'satadmin:support {support}';

    protected $description = 'Create a new support [Class name model]';

    public function handle()
    {
        $version = explode('.', app()->version())[0];

        $support = $this->argument('support');
        $bddName = strtolower ($this->argument('support')) . 's';

        if($version <= 8){
            $model   = '\App\Models\\' . $support;
        } else {
            $model   = '\App\\' . $support;
        }

        $Content = "<?php 

namespace App\Satadmin;

use Jviatge\Satadmin\Support as Support;

class {$support} extends Support
{
    public static function label() 
    {
        return '{$bddName}';
    }

    public static function table() 
    {
        return  {$model}::class;
    }

    public static function fieldSearch() 
    {
        return 'name';
    }

    public static function fields() 
    {    
        return  [

            
        ];
    }

}";
        Storage::disk('Satadmin')->put($support . 's.php', $Content);
        $this->info('Support are created !');
    }
}
