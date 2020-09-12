<?php

namespace Jviatge\Satadmin\fields;

abstract class TextEdit extends CheckSegment{

    static function create(...$arguments)
    {
        $section = parent::section();
        $class = new Option($arguments, 'textedit', $section);
        return $class;
    }

} 
