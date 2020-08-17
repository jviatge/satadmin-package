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

        $support = $this->argument('support');
        $bddName = strtolower ($this->argument('support')) . 's';

        $Content = "<?php 

namespace App\Satadmin;


class {$support}s 
{
    public static function label() 
    {
        return '{$bddName}';
    }

    public static function support() 
    {
        return '{$bddName}';
    }

    public static function table() 
    {
        return  \App\\{$support} ::class;
    }

    public static function fields() 
    {    
        return  [

            
        ];
    }

}";


        Storage::disk('app')->put($support . 's.php', $Content);
        $this->info('Support are created !');
    }
}
