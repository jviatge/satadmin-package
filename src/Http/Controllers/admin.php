<?php

namespace Jviatge\Satadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jviatge\Satadmin\Layout;
use Illuminate\Support\Facades\Storage;
use Jviatge\Satadmin\Http\Fields;

class admin extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->fields       =   new Fields();
    }

    public function homePanel()
    {
        return view('satadmin::homePanel',[

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel()

        ]); 
    }

    public function supportPanel($support)
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
        $fields = $this->fields->createField($option, $model, $myClass);


        return view('satadmin::support/supportPanel', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,

            'fields'        =>  $fields
        
        ]);
    }

    public function supportNew($support)
    {
        // BASE CLASS
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;
      
      
        // OPTION
        $tabJson = json_encode($myClass->fields());
        $option = (array) json_decode($tabJson,true);

        // CREATE VIEW
        $fields = $this->fields->createField($option, $myClass);


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
        $fields = $this->fields->createField($option, $model, $myClass);

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
        $fields = $this->fields->createField($option, $model);

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

}


