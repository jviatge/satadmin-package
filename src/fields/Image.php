<?php

namespace Jviatge\Satadmin\fields;

use Jviatge\Satadmin\fields\options\CheckSegment;
use Jviatge\Satadmin\fields\options\Option;

abstract class Image extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'image', $section);
        return $class;
    }

} 


