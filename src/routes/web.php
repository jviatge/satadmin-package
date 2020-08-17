<?php

Route::group(['namespace' => 'Jviatge\Satadmin\Http\Controllers','middleware' => ['web']], function () {
    
    Route::get('/admin', 'admin@homePanel')->name('admin.home');;

    Route::get('/admin/{support}', 'admin@supportPanel')->name('admin');
    Route::get('/admin/{support}/new', 'admin@supportNew')->name('admin.new');
    Route::post('/admin/{support}/add', 'admin@supportAdd')->name('admin.add');
    Route::get('/admin/{support}/delete/{id}', 'admin@supportDelete')->name('admin.delete');

    // Route::post('/admin/users/update/{id}', 'admin@userUpdateRequest')->name('admin.user.update.request');
    // Route::get('/admin/users/update/{id}', 'admin@userUpdate')->name('admin.user.update');
    // Route::get('/admin/users/details/{id}', 'admin@userDetails')->name('admin.user.details');
    
});
