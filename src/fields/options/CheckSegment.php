<?php

namespace Jviatge\Satadmin\fields\options;

class CheckSegment {

    public static function section()
    {
        if(request()->segments()[count(request()->segments()) - 1] == 'new')
        {
            return 'new';
        }
        else if(request()->segments()[count(request()->segments()) - 2] == 'update')
        {
            return 'update';
        }
        else if(request()->segments()[count(request()->segments()) - 2] == 'details')
        {
            return 'details';
        }
        else
        {
            return 'panel';
        }
    }   

} 


