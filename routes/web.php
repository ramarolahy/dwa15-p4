<?php
    // I will add the home page once we have DB setup so I display any
    // previously created poster from different users
    //Route::get ( '/', 'HomeController@Index')->name('pages.index');

    Auth::routes ();
    // READ
    Route::get ('/', 'HomeController@home')->name ('home');
    Route::get ('/search', 'HomeController@home')->name ('search.get');
    Route::post ('/search', 'HomeController@search')->name ('search.post');
    // Only logged in users can Create, Update, and Delete Posters
    Route::group(['middleware' => 'auth'], function () {
        // CREATE
        Route::get ('/create', 'QuoteController@create')->name ('create');
        Route::get ('/new', 'QuoteController@create')->name ('new.get');
        Route::post ('/new', 'QuoteController@new')->name ('new.post');

        Route::get ('/save', 'QuoteController@create')->name ('save.get');
        Route::post ('/save', 'QuoteController@save')->name ('save.post');
        // UPDATE
        Route::get ('/edit', 'QuoteController@create')->name ('edit.get');
        Route::post ('/edit', 'QuoteController@edit')->name ('edit.post');
        Route::put ('/save/{posterId?}', 'QuoteController@save')->name ('save');
        // DELETE
        Route::delete ('/delete/{posterId}', 'QuoteController@delete')->name ('delete');
    });




