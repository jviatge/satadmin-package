<?php

namespace Jviatge\Satadmin\Console;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userCommand extends Command
{
    
    protected $signature = 'satadmin:user';

    protected $description = 'Create a new user admin';

    public function handle()
    {
        $this->info('Create a new user :');

        $name = $this->ask('Name');

        $email = $this->ask('Email');

        $password = $this->secret('Password');

        $hash = Hash::make($password);

        $myModel =  \App\User::class;
        $myModel::create([
            'name' => $name,
            'email' => $email,
            'password' => $hash
        ]);

        $this->info('Finish !');

    }
}
