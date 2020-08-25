<?php

namespace Jviatge\Satadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Jviatge\Satadmin\Ressources;
use Jviatge\Satadmin\Layout;

class admin extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $fields = $this->createFields($option, $model);

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
        $fields = $this->createFields($option, $myClass);


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
        $checkedClass = Layout::Support($support);
        $myClass = new $checkedClass;

        $table          =   DB::getSchemaBuilder()->getColumnListing($support);
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

                        $myData[$colunm] = $value;
                        // Hash::make($password);
                        
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
        $fields = $this->createFields($option, $model);
        // dd($fields);


        return view('satadmin::support/supportDetails', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,

            'fields'        =>  $fields
        
        ]);
      
    }

    public function supportDelete($support, $id)
    { 

        DB::table($support)->where('id', $id)->delete();

        return redirect('admin/' . $support);
        
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
        $fields = $this->createFields($option, $model);

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
    
        $table          =   DB::getSchemaBuilder()->getColumnListing($support);
        $myData         =   [];

        
        if($request->hash){
            // HASH PASSWORD
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
                        $myData[$colunm] = $value;             
                    }
                }
            }
        } 

        $myClass->table()::where('id', $id)->update($myData);
       
        return redirect('admin/' . $support);

    }


    function createFields ($option, $data)
    {
        $arrViews = [];

        for ($i=0; $i < count($option); $i++) { 

            $section        =   $option[$i]['section'];
            $view           =   'satadmin::' . $option[$i]['type'];
            $show           =   true;
            
            //PANEL
            if($section == 'panel')
            {
                // GET VALUE
                $arrValues  =   $data
                                ->map
                                ->only($option[$i]['fieldName'])
                                ->toArray();
                $value      =   [];
                foreach($arrValues as $arrValue)
                {
                    array_push($value, $arrValue[$option[$i]['fieldName']]); 
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

                // DONT SHOW PASSWORD
                ($option[$i]['type'] == 'password') ? $show = false : null;
                
            }
            
            //DETAILS
            if($section == 'details')
            {
                
                $arrValues  =   $data
                                ->map
                                ->only($option[$i]['fieldName'])
                                ->toArray();
                $value      =   [];
                foreach($arrValues as $arrValue)
                {
                    array_push($value, $arrValue[$option[$i]['fieldName']]); 
                }
           
                $id         =   $data
                                ->map
                                ->only('id')
                                ->toArray()[0]['id'];

                // DONT SHOW PASSWORD
                ($option[$i]['type'] == 'password') ? $show = false : null;

            }
       
            
            //UPDATE 
            if ($section == 'update')
            {
                $value      =   $data
                                ->map
                                ->only($option[$i]['fieldName'])
                                ->toArray()[0][$option[$i]['fieldName']];

                $id         =   null;
            } 

            //NEW 
            if ($section == 'new')
            {
                $value      =   null;
                $id         =   null;
            }
            
            if($show){
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
        
        return $arrViews;
    }

    function myView ($section, $view, $arr) {

        return ($section == 'panel' || $section == 'details') ? $arr : view($view, $arr);
        
    }

}
