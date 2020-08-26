<?php 

namespace App\Satadmin;

use Jviatge\Satadmin\fields\Email;
use Jviatge\Satadmin\fields\Text;
use Jviatge\Satadmin\fields\Password;
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

}