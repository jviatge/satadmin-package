<?php

namespace Jviatge\Satadmin\fields;

class Text
{
    
    /**
     *
     * @return void
     */
    public static function create($name, $field)
    {
        return view('satadmin::text',[

            'field' => $field,
            'name' => $name
            
        ]); 
    }


} 