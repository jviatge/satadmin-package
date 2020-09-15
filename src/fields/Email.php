<?php

namespace Jviatge\Satadmin\fields;

use Jviatge\Satadmin\fields\options\CheckSegment;
use Jviatge\Satadmin\fields\options\Option;

abstract class Email extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'email', $section);
        return $class;
    }

} 


