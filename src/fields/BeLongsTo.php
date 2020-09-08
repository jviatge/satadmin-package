<?php

namespace Jviatge\Satadmin\fields;

abstract class BeLongsTo extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'belongsto', $section);
        return $class;
    }

} 


