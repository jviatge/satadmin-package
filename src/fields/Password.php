<?php

namespace Jviatge\Satadmin\fields;

abstract class Password extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'password', $section);
        return $class;
    }

} 


