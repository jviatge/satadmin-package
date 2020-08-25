<?php

namespace Jviatge\Satadmin\fields;

abstract class Select extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'select', $section);
        return $class;
    }

} 


