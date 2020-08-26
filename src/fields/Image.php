<?php

namespace Jviatge\Satadmin\fields;

abstract class Image extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'image', $section);
        return $class;
    }

} 


