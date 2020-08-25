<?php

namespace Jviatge\Satadmin\fields;

abstract class Text extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'text', $section);
        return $class;
    }

} 


