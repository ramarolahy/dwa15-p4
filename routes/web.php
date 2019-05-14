<?php

    Auth::routes ();
    // READ
    Route::get ('/', 'HomeController@home')->name ('home');
    Route::get ('/search', 'HomeController@home')->name ('search.get');
    Route::post ('/search', 'HomeController@search')->name ('search.post');
    // Only logged in users can Create, Update, and Delete Posters
    Route::group(['middleware' => 'auth'], function () {
        // CREATE, UPDATE
        Route::get ('/print', 'QuoteController@print')->name ('print.get');
        Route::post ('/print', 'QuoteController@print')->name ('print.post');

        Route::get ('/save', 'QuoteController@print')->name ('save.get');
        Route::post ('/save', 'QuoteController@save')->name ('save.post');

        Route::put ('/save/{posterId?}', 'QuoteController@save')->name ('save');
        // DELETE
        Route::delete ('/delete/{posterId}', 'QuoteController@delete')->name ('delete');
    });




