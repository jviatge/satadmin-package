<?php

namespace Jviatge\Satadmin\Http;

class Fields
{
    
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->section      =   false;
    }

    public function createField($option, $data, ...$arr)
    {
        isset($arr[0]) ? $class  =  $arr[0] : null;

        $arrViews   =   [];

        for ($i=0; $i < count($option); $i++) { 

            ($this->section == false) ? $section = $option[$i]['section'] : 
            $section        =   $this->section;
            $view           =   'satadmin::' . $option[$i]['type'];
            $show           =   true;
            $extend         =   [];
            
            //PANEL
            if($section == 'panel')
            {
                
                if( $option[$i]['type'] != 'hasmany' && 
                    $option[$i]['type'] != 'password'){

                     // GET VALUE 
                    $arrValues  =   $data
                                    ->map
                                    ->only($option[$i]['fieldName'])
                                    ->toArray();
                    $value      =   [];
                    foreach($arrValues as $arrValue)
                    {
                        // FIELD VIEW
                        if( $option[$i]['type'] == 'image'      || 
                            $option[$i]['type'] == 'email'      ||
                            $option[$i]['type'] == 'belongsto'  ||
                            $option[$i]['type'] == 'textedit'){
                            
                            // BLOCAGE 
                            // ($option[$i]['section'] == 'details') ?  $show = false : null;
         
                            if($option[$i]['type'] == 'belongsto')
                            {
                                $classSeg = explode('\\',get_class($data[0]))[2];

                            } else {
                                $classSeg = null;
                            }
             
                            array_push($value, view($view, [

                                'classSeg'      =>  $classSeg,
                                'data'          =>  $option[$i],
                                'section'       =>  $section,
                                'value'         =>  $arrValue[$option[$i]['fieldName']

                            ]])); 
                        }  
                        else {
                            array_push($value, $arrValue[$option[$i]['fieldName']]); 
                        } 
                    }  

                    // GET ID
                    $arrIds     =   $data
                                    ->map
                                    ->only('id')
                                    ->toArray();
                    $id         =   [];
                    foreach($arrIds as $arrId)
                    {
                        array_push($id, $arrId['id']);
                    }

                } else { $show = false; }
            }
                   
            //DETAILS
            if($section == 'details')
            {

                if( $option[$i]['type'] != 'hasmany' &&
                    $option[$i]['type'] != 'password')
                {

                    $arrValues  =   $data
                                    ->map
                                    ->only($option[$i]['fieldName'])
                                    ->toArray();
                    $value      =   [];
                    foreach($arrValues as $arrValue)
                    {
    
                        // FIELD VIEW
                        if( $option[$i]['type'] == 'image'      || 
                            $option[$i]['type'] == 'email'      ||
                            $option[$i]['type'] == 'belongsto'  ||
                            $option[$i]['type'] == 'textedit'){   

                            if($option[$i]['type'] == 'belongsto')
                            {
                                $classSeg = explode('\\',get_class($data[0]))[2];
                            } else {
                                $classSeg = null;
                            }

                            array_push($value, view($view, [

                                'classSeg'      =>  $classSeg,
                                'data'          =>  $option[$i],
                                'section'       =>  $section,
                                'value'         =>  $arrValue[$option[$i]['fieldName']
    
                            ]])); 
                        } else {
                            array_push($value, $arrValue[$option[$i]['fieldName']]); 
                        } 
                   
                    }
               
                    $id         =   $data
                                    ->map
                                    ->only('id')
                                    ->toArray()[0]['id'];

                } else {            
                    ($option[$i]['type'] == 'hasmany') ? 
                        array_push($extend, $option[$i], $data)
                        : null;
                    $show = false;
                }
            }
       
            //UPDATE 
            if ($section == 'update')
            {
                if( $option[$i]['type'] == 'hasmany')
                {
                    $show = false;

                } elseif($option[$i]['type'] == 'belongsto') {

                    $myClass    =   $option[$i]['arr']::table();
                    $searchable =   $option[$i]['arr']::fieldSearch();
                    $myClass    =   new $myClass;

                    $value      =   $myClass::get()->pluck($searchable, 'id');
                    $id         =   $data;
                    
                } else {

                    $value      =   $data
                                    ->map
                                    ->only($option[$i]['fieldName'])
                                    ->toArray()[0][$option[$i]['fieldName']];
    
                    $id         =   null;
                  
                }
            } 

            //NEW 
            if ($section == 'new')
            {
                if( $option[$i]['type'] == 'hasmany'){

                    $show = false;

                } elseif($option[$i]['type'] == 'belongsto') {

                    $myClass    =   $option[$i]['arr']::table();
                    $searchable =   $option[$i]['arr']::fieldSearch();
                    $myClass    =   new $myClass;

                    $value      =   $myClass::get()->pluck($searchable, 'id');
                    $id         =   null;
                    
                } else {   

                    $value      =   null;
                    $id         =   null;
                }
            }
            
            if($show)
            {
                array_push($arrViews, $this->myView($section, $view, [
    
                    'label'         =>  $option[$i]['label'],
                    'fieldName'     =>  $option[$i]['fieldName'],
                    'value'         =>  $value,
                    'section'       =>  $section,
                    'option'        =>  $option[$i],
                    'id'            =>  $id,
                    'arr'           =>  $option[$i]['arr'],
                    'required'      =>  $option[$i]['param']['required']
                    
                ]));
            }
        }

        if(isset($extend) && $extend != null)
        {
            array_push($arrViews, $this->newTab($extend[0], $class, $id));
        }

        return $arrViews;
    }
    
    public function newTab($option, $class, $id)
    {
        $myClass            =   new $option['arr'];
        $this->section      =   'panel';     
        $modelActu          =   $class->table()::all();
        $model              =   [];
        $classSeg           =   strtolower(explode('\\',get_class($class))[2]. '_id');

        foreach($modelActu as $firstMod)
        {
            foreach($firstMod[$option['fieldName']] as $eloquentR)
            {
                ($eloquentR[$classSeg] == $id) ? array_push($model, $eloquentR) : null;
            }
        }
      
        // OPTION
        $tabJson = json_encode($myClass->fields());
        $optionJson = (array) json_decode($tabJson,true);

        // CREATE VIEW
        $fields = $this->createField($optionJson, collect($model));

        // dd($option['arr']);
       
        return ['extend' =>  view('satadmin::blocks/array', [

            'name'          =>  $option['label'],
            'slug'          =>  strtolower(explode("\\",$option['arr'])[2]),
            'fields'        =>  $fields
        
        ])];
    }

    public function myView($section, $view, $arr)
    {
        return ($section == 'panel' || $section == 'details') ? $arr : view($view, $arr);      
    }

}
