<?php

namespace Jviatge\Satadmin\fields;

abstract class Textarea extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'textarea', $section);
        return $class;
    }

} 
