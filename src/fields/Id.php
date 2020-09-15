<?php

namespace Jviatge\Satadmin\fields;

use Jviatge\Satadmin\fields\options\CheckSegment;
use Jviatge\Satadmin\fields\options\Option;

abstract class Id extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'id', $section);
        return $class;
    }

} 


