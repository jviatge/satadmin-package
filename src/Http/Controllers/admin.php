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
use Auth;

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

        $checkedClass   = Layout::Support($support);
        $myClass        = new $checkedClass;

        $fieldsActiv    = [];
        $fieldsName     = [];

        for ($i=0; $i < count($myClass->fields()); $i++) { 
            if($myClass->fields()[$i]->getName() != 'satadmin::password'){

                array_push($fieldsActiv, $myClass->fields()[$i]->getData()['field']);
                array_push($fieldsName, $myClass->fields()[$i]->getData()['name']);

            }
        }

        $order  = 'created_at';

        try {

            $model      = $myClass->table()::orderBy($order, 'desc')->get();
            $listFields = $model->map->only($fieldsActiv);
            $selectId   = $model->map->only('id')->toArray();


        } catch (\Throwable $th) {

            $selectId = '';
            $listFields = [];

        }
        
        return view('satadmin::support/supportPanel', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,

            'listFields'    =>  $listFields,
            'ids'           =>  $selectId,
            'fields'        =>  $fieldsName,

        ]);
    }

    public function supportNew( $support )
    {
        $checkedClass = Layout::Support($support);
        $myClass = new $checkedClass;

        return view('satadmin::support/supportNew', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,
            'fields'        =>  $myClass->fields(),

        ]);
    }

    public function supportAdd(Request $request, $support)
    { 
        $checkedClass = Layout::Support($support);
        $myClass = new $checkedClass;

        $table   =   DB::getSchemaBuilder()->getColumnListing($support);
        $myData  =   [];
    
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
        $checkedClass   =   Layout::Support($support);
        $myClass        =   new $checkedClass;

        $fieldsActiv    =   [];
        $fieldsName     =   [];

        for ($i=0; $i < count($myClass->fields()); $i++) { 
            if($myClass->fields()[$i]->getName() != 'satadmin::password'){

                array_push($fieldsActiv, $myClass->fields()[$i]->getData()['field']);
                array_push($fieldsName, $myClass->fields()[$i]->getData()['name']);

            }
        }

        $model          =   $myClass->table()::where('id', $id)->get();
        $listFields     =   $model->map->only($fieldsActiv)[0];
        // dd($listFields);

        // dd($listFields, $fieldsName);


        return view('satadmin::support/supportDetails', [

            'supports'      =>  Layout::listSupport(),
            'labels'        =>  Layout::listLabel(),
            'name'          =>  $myClass->label(),
            'slug'          =>  $support,

            'listFields'    =>  $listFields,
            'fields'        =>  $fieldsName,

        ]);

      
    }

    public function supportDelete($support, $id)
    { 
      
        
        DB::table($support)->where('id', $id)->delete();

        
        // $email = Auth::user()->email;
        // $user = User::where('id', $id)->get()->first();

        // if($user->email != $email){

        //     $user->delete();

        // }

        return redirect('admin/' . $support);
    }




    
    public function userUpdate($id)
    { 

        $user = User::where('id', $id)->get()->first();

        // $user->name = 'Josex';
        // $user->save();

        return view('satadmin::users/userUpdate', [
            'name' => $this->name,
            'user' => $user
        ]);
    }

    public function userUpdateRequest(Request $request, $id)
    { 
        $name = request('name');
        $email = request('email');
        $password = request('password');

        $user = User::where('id', $id)->get()->first();
            
        $user->name = $name;
        $user->email = $email;

        if($password != null){
            $user->password = Hash::make($password);
        }

        $user->save();

        return redirect('admin/users');

    }

}
