<?php 

namespace Jviatge\Satadmin\fields\options;
use JsonSerializable;

class JsonSendOk implements JsonSerializable {


    public function __construct($ok)
    {
       $this->dqd = $ok;
       
    }

    public function jsonSerialize() {
        
        return ['ok' => 'ok'];
        // return $this->dqd;
    }

}