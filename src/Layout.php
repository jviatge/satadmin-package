<?php

namespace Jviatge\Satadmin;
use Jviatge\Satadmin\Ressources;

class Layout
{
    
    /**
     *
     * @return array
     * 
     */
    public static function listSupport()
    {
        $listTab = [];

        foreach(Ressources::resourcesIn() as $support){

            $r = new $support; 
            array_push($listTab, $r->support());

        }

        return $listTab;
    }

    /**
     *
     * @return array
     * 
     */
    public static function listLabel()
    {
        $listLabel = [];

        foreach(Ressources::resourcesIn() as $label){

            $r = new $label; 
            array_push($listLabel, $r->label());

        }

        return $listLabel;
    }

    /**
     *
     * @return string
     * 
     */
    public static function support( $support )
    {
        foreach(Ressources::resourcesIn() as $className){

            $segement = explode("\\", $className);

            if(strtolower($segement[2]) == strtolower($support)){

                return $className;

            }
        }
    }

} 