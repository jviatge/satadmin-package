<?php

namespace Jviatge\Satadmin\fields;

class Password
{
    
    /**
     *
     * @return void
     */
    public static function create($name, $field)
    {
        return view('satadmin::password',[

            'field' => $field,
            'name' => $name
            
        ]); 
    }


} 