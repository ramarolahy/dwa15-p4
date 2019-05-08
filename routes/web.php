<?php
    // I will add the home page once we have DB setup so I display any
    // previously created poster from different users
    //Route::get ( '/', 'HomeController@Index')->name('pages.index');

    Auth::routes ();
    // READ
    Route::get ('/', 'HomeController@home')->name ('home');
    Route::post ('/search', 'HomeController@search')->name ('search');
    // Only logged in users can Create, Update, and Delete Posters
    Route::group(['middleware' => 'auth'], function () {
        // CREATE
        Route::get ('/create', 'QuoteController@create')->name ('create');
        Route::post ('/new', 'QuoteController@new')->name ('new');
        Route::post ('/save', 'QuoteController@save')->name ('save');
        // UPDATE
        Route::post ('/edit', 'QuoteController@edit')->name ('edit');
        Route::put ('/save/{posterId?}', 'QuoteController@save')->name ('save');
        // DELETE
        Route::delete ('/delete/{posterId}', 'QuoteController@delete')->name ('delete');
    });




