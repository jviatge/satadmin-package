<?php

namespace Jviatge\Satadmin\fields;

abstract class Id extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'id', $section);
        return $class;
    }

} 


