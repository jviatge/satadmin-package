<?php

namespace Jviatge\Satadmin\fields;

class Email
{
    
    /**
     *
     * @return void
     */
    public static function create($name, $field)
    {
        return view('satadmin::email',[

            'field' => $field,
            'name' => $name
            
        ]); 
    }


} 