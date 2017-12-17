<?php

Route::group(['prefix' => 'comment','middleware'=>['web']], function() {
    Route::get('demo', 'Bantenprov\Comment\Http\Controllers\CommentController@demo');

    Route::get('/','Bantenprov\Comment\Http\Controllers\CommentController@index')->name('commentIndex');

    // Route::get('/create','Bantenprov\Comment\Http\Controllers\CommentController@create')->name('commentCreate');

    // Route::post('/store','Bantenprov\Comment\Http\Controllers\CommentController@store')->name('commentStore');
    
    Route::get('/{id}/show','Bantenprov\Comment\Http\Controllers\CommentController@show')->name('commentShow');

    Route::get('/edit','Bantenprov\Comment\Http\Controllers\CommentController@edit')->name('commentEdit');

    Route::post('/update/{id}','Bantenprov\Comment\Http\Controllers\CommentController@update')->name('commentUpdate');

    Route::get('/view/{id}','Bantenprov\Comment\Http\Controllers\CommentController@show')->name('commentShow');

    Route::get('/delete/{id}','Bantenprov\Comment\Http\Controllers\CommentController@destory')->name('commentDestroy');
});
