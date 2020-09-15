<?php

namespace Jviatge\Satadmin\fields;

use Jviatge\Satadmin\fields\options\CheckSegment;
use Jviatge\Satadmin\fields\options\Option;

abstract class Password extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'password', $section);
        return $class;
    }

} 


