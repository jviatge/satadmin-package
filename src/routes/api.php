<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'Jviatge\Satadmin\Http\Controllers'], function () {
    Route::group(['middleware' => ['web']], function () {
        Route::group(['middleware' => 'auth'], function () {
    
            Route::get('/api/test', function(){
                // $get = [
                //     ['name' => 'Progression', 'col' => ['josex','satannas','Pantoufle','josex','satannas','Pantoufle'], 'value' => [3,10,8,3,10,8]],
                //     ['name' => 'Game', 'col' => ['Overwatch','League of legends','Rocket league'], 'value' => [10,11,9]],
                //     ['name' => 'Game', 'col' => ['dgljd','xcvvxv'], 'value' => [10,9]],
                // ];
                $get = [];
        
                return json_encode($get);
            });
    
        });
    });
});

