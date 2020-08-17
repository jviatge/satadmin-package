<?php 

namespace App\Satadmin;

abstract class Table 
{
    // Force les classes filles à définir cette méthode
    abstract public static function label();

}