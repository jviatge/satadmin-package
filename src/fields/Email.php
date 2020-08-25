<?php

namespace Jviatge\Satadmin\fields;

abstract class Email extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'email', $section);
        return $class;
    }

} 


