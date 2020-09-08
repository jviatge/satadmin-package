<?php

namespace Jviatge\Satadmin\fields;

abstract class HasMany extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'hasmany', $section);
        return $class;
    }

} 


