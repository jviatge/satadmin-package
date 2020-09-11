<?php

namespace Jviatge\Satadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jviatge\Satadmin\Layout;
use Illuminate\Support\Facades\Storage;

class admin extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->section = false;
    }

    public function homePanel()
    {
        return view('satadmin::homePanel',[

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel()

        ]); 
    }

    public function supportPanel( $support )
    {
        // BASE CLASS
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
      

        // DATA
        $order          =   'created_at';
        $model          =   $myClass->table()::orderBy($order, 'desc')->get();

      
        // OPTION
        $tabJson = json_encode($myClass->fields());
        $option = (array) json_decode($tabJson,true);

        // CREATE VIEW
        $fields = $this->createField($option, $model, $myClass);

        return view('satadmin::support/supportPanel', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,

            'fields'        =>  $fields
        
        ]);
    }

    public function supportNew( $support )
    {
        // BASE CLASS
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
      
      
        // OPTION
        $tabJson = json_encode($myClass->fields());
        $option = (array) json_decode($tabJson,true);

        // CREATE VIEW
        $fields = $this->createField($option, $myClass);


        return view('satadmin::support/supportNew', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),

            'slug'          =>  $support,
            'fields'        =>  $fields

        ]);
    }

    public function supportSendNew(Request $request, $support)
    { 
        // $this->validate($request, [
        //     'input_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $checkedClass = Layout::Support($support);
        $myClass = new $checkedClass;

        $table          =   DB::getSchemaBuilder()->getColumnListing($support . 's');
        $myData         =   [];

        // HASH PASSWORD
        if($request->hash){
            $hash  =  $request->hash;
            $request[$hash] = Hash::make($request[$hash]);
        }

        foreach($request->all() as $key => $value) {
            foreach ($table as $colunm) {
                if($key == $colunm){
                    if($value != null){

                        //TRAITEMENT FILE
                        if($request->hasFile($colunm)){

                            //TRAITEMENT IMAGE
                            if($request[$colunm]->extension() == 'jpeg' ||  $request[$colunm]->extension() == 'png'){
                                
                                $file = $request->file($colunm);
                                Storage::disk('public')->put('images/', $file);
                                $myData[$colunm] = $file->hashName();
                            
                            // OTHER FILE
                            } else {

                                $file = $request->file($colunm);
                                Storage::disk('public')->put('other/', $file);
                                $myData[$colunm] = $file->hashName();

                            }
                            
                        } else {

                            $myData[$colunm] = $value;

                        }                        
                    }
                }
            }
        }

        $myClass->table()::create($myData);

        return redirect('admin/' . $support);

    }

    public function supportDetails($support, $id)
    {

        // BASE CLASS
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
      
        // DATA
        $model          =   $myClass->table()::where('id', $id)->get();

        // OPTION
        $tabJson = json_encode($myClass->fields());
        $option = (array) json_decode($tabJson,true);

        // CREATE VIEW        
        $fields = $this->createField($option, $model, $myClass);

        return view('satadmin::support/supportDetails', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,
            'id'            =>  $id,

            'fields'        =>  $fields
        
        ]);
      
    }

    public function supportDelete($support, $id)
    { 
        
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
        $model          =   $myClass->table()::where('id', $id);

        // CHECK AND REMOVE FILE
        $checkfile = $model->get()->map->toArray();
        $where = ['images/','other/'];
        foreach($checkfile[0] as $key => $value)
        {
            foreach($where as $path)
            {
                if(Storage::disk('public')->exists($path. $value))
                {
                    Storage::disk('public')->delete($path. $value);
                } 
            }
        }

        $model->delete();
        return back();
    }

    public function supportUpdate($support, $id)
    {
        // BASE CLASS
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
      
        // DATA
        $model          =   $myClass->table()::where('id', $id)->get();
      
        // OPTION
        $tabJson = json_encode($myClass->fields());
        $option = (array) json_decode($tabJson,true);

        // CREATE VIEW
        $fields = $this->createField($option, $model);

        return view('satadmin::support/supportUpdate', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'id'            =>  $id,

            'slug'          =>  $support,
            'fields'        =>  $fields
        
        ]);
    }

    public function supportSendUpdate(Request $request, $support, $id)
    { 
        // BASE CLASS
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
        $model          =   $myClass->table()::where('id', $id);
    
        $table          =   DB::getSchemaBuilder()->getColumnListing($support . 's');
        $myData         =   [];

        
        // HASH PASSWORD
        if($request->hash){
            $hash  =  $request->hash;
            if($request[$hash] != null){
                $request[$hash] = Hash::make($request[$hash]);
            } else {
                unset($request[$hash]);
            }
        }   

        foreach($request->all() as $key => $value) {
            foreach ($table as $colunm) {
                if($key == $colunm){
                    if($value != null){
                        if($request->hasFile($colunm)){

                             // CHECK AND REMOVE FILE
                            $checkfile = $model->get()->map->toArray();
                            $where = ['images/','other/'];
                            foreach($checkfile[0] as $key => $value)
                            {
                                foreach($where as $path)
                                {
                                    if(Storage::disk('public')->exists($path. $value))
                                    {
                                        Storage::disk('public')->delete($path. $value);
                                    } 
                                }
                            }

                            //TRAITEMENT IMAGE
                            if($request[$colunm]->extension() == 'jpeg' ||  $request[$colunm]->extension() == 'png'){
                                
                                $file = $request->file($colunm);
                                Storage::disk('public')->put('images/', $file);
                                $myData[$colunm] = $file->hashName();
                            
                            // OTHER FILE
                            } else {

                                $file = $request->file($colunm);
                                Storage::disk('public')->put('other/', $file);
                                $myData[$colunm] = $file->hashName();

                            }
                            
                        } else {
                            $myData[$colunm] = $value;             
                        }
                    }
                }
            }
        } 

        $myClass->table()::where('id', $id)->update($myData);
       
        return redirect('admin/' . $support);

    }


    function createField ($option, $data, ...$arr)
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
                        if( $option[$i]['type'] == 'image' || 
                            $option[$i]['type'] == 'email' ||
                            $option[$i]['type'] == 'belongsto'){
                            
                            // BLOCAGE 
                            ($option[$i]['section'] == 'details') ?  $show = false : null;
         
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
                        if( $option[$i]['type'] == 'image' || 
                            $option[$i]['type'] == 'email' ||
                            $option[$i]['type'] == 'belongsto'){   

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
                    'arr'           =>  $option[$i]['arr']
                    
                ]));
            }
        }

        if(isset($extend) && $extend != null)
        {
            array_push($arrViews, $this->newTab($extend[0], $class, $id));
        }

        return $arrViews;
    }
    
    function newTab($option, $class, $id)
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

    function beLongsTo($option, $class)
    {
        $modelActu          =   $class->table()::all();
        $model              =   [];
        foreach($modelActu as $firstMod)
        {
            array_push($model, $firstMod[$option['fieldName']]);
        }   
        
        return $model;
    }

    function myView ($section, $view, $arr)
    {
        return ($section == 'panel' || $section == 'details') ? $arr : view($view, $arr);      
    }

}


