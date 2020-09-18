<?php 

namespace Jviatge\Satadmin\fields\options;

use Jviatge\Satadmin\fields\options\JsonSend;
use JsonSerializable;
// implements JsonSerializable
class Option implements JsonSerializable{

    public function __construct($arguments, $type, $section)
    {

        $this->arguments            =   $arguments; 
        $this->fieldName            =   $arguments[1]; 
        $this->type                 =   $type;    
        $this->section              =   $section; 

        $this->param['required']    =   false;
    
        (isset($arguments[2])) ? $this->arr = $arguments[2] : $this->arr = null;

    }

    public function name () 
    {
        return $this->arguments[0];
    }

    public function validate($array) 
    {
    
        // dd($array, $this->type);
        $require        =   false;
        foreach($array as $checkRequire){
            ($checkRequire == 'required') ? $require = true : null;   
        }
        $this->param    =  ['validate' => implode("|", $array)];
        $this->param['required'] = $require;
    
        $base   = [
            'param'     =>  $this->param,

            'label'     =>  $this->name(),
            'fieldName' =>  $this->fieldName,
            'type'      =>  $this->type,
            'section'   =>  $this->section,
            'arr'       =>  $this->arr
        ];
      
        return $base;
    }

    // public function send()
    // {
    //     return [
    //         'label'     =>  $this->name(),
    //         'fieldName' =>  $this->fieldName,
    //         'type'      =>  $this->type,
    //         'section'   =>  $this->section,
    //         'arr'       =>  $this->arr
    //     ];

    //     // $base);

    //     // json_encode(, JSON_PRETTY_PRINT);
    // }

    public function jsonSerialize() {
        
        $base   = [
            'param'     =>  $this->param,

            'label'     =>  $this->name(),
            'fieldName' =>  $this->fieldName,
            'type'      =>  $this->type,
            'section'   =>  $this->section,
            'arr'       =>  $this->arr
        ];

        return $base;
    }

}

