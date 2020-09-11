<?php

namespace Jviatge\Satadmin\Console;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Jviatge\Satadmin\console\NpmPackage;

class testCommand extends Command
{
    
    protected $signature = 'satadmin:test';

    protected $description = 'Testing jusqua le mise a mort';

    public function handle()
    {
        
        $this->info('test');

    }
}
