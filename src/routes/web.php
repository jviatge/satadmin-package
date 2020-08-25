<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Jviatge\Satadmin\Http\Controllers'], function () {
    
    Route::group(['middleware' => ['web']], function () {

        Route::get('/admin/login', 'portal@login')->name('login');
        Route::get('/logout', 'portal@logout')->name('logout');
        Route::post('/admin/login/send', 'portal@authenticate')->name('admin.login.send');

        Route::group(['middleware' => 'auth'], function () {
            
            $slug = config('satadmin.slug');

            Route::get('/' . $slug, 'admin@homePanel')->name('admin.home');;
            Route::get('/' . $slug .'/{support}', 'admin@supportPanel')->name('admin');
            Route::get('/' . $slug .'/{support}/new', 'admin@supportNew')->name('admin.new');
            Route::post('/' . $slug .'/{support}/send/new', 'admin@supportSendNew')->name('admin.send.new');
            Route::get('/' . $slug .'/{support}/delete/{id}', 'admin@supportDelete')->name('admin.delete');  
            Route::get('/' . $slug .'/{support}/details/{id}', 'admin@supportDetails')->name('admin.details');
            Route::get('/' . $slug .'/{support}/update/{id}', 'admin@supportUpdate')->name('admin.update');
            Route::post('/' . $slug .'/{support}/send/update/{id}', 'admin@supportSendUpdate')->name('admin.send.update');

        });
    });
});
