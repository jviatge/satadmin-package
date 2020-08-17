<?php

namespace Jviatge\Satadmin\fields;

class Id
{
    
    /**
     *
     * @return void
     */
    public static function create()
    {
        return view('satadmin::id',[

            'field' => 'id',
            'name' => 'Id'
            
        ]); 
    }


} 