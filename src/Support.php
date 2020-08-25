<?php

namespace Jviatge\Satadmin;

class Support {

    public function support() 
    {
        return explode("\\", static::class)[2];
    }

}