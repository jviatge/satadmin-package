<?php 

namespace App\Satadmin;

use Jviatge\Satadmin\Table;
use Illuminate\Support\Facades\DB;
use Jviatge\Satadmin\fields\Id;
use Jviatge\Satadmin\fields\Email;
use Jviatge\Satadmin\fields\Text;
use Jviatge\Satadmin\fields\Password;

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

}