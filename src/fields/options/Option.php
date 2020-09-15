<?php 

namespace Jviatge\Satadmin\fields\options;
use JsonSerializable;

class Option implements JsonSerializable {

    public function __construct($arguments, $type, $section)
    {

        $this->arguments    =   $arguments; 
        $this->fieldName    =   $arguments[1]; 
        $this->type         =   $type;    
        $this->section      =   $section; 

        (isset($arguments[2])) ? $this->arr = $arguments[2] : $this->arr = null;
      
    }

    public function name () {
        return $this->arguments[0];
    }

    public function jsonSerialize() {
        return array_merge([

            'label'     =>  $this->name(),
            'fieldName' =>  $this->fieldName,
            'type'      =>  $this->type,
            'section'   =>  $this->section,
            'arr'       =>  $this->arr
            
        ]);
    }


}

