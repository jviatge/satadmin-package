<?php

namespace Jviatge\Satadmin\fields;

class Textarea
{
    
    /**
     *
     * @return void
     */
    public static function create($name, $field)
    {
        return view('satadmin::textarea',[

            'field' => $field,
            'name' => $name
            
        ]); 
    }


} 