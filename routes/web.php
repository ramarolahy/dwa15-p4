<?php
    // I will add the home page once we have DB setup so I display any
    // previously created poster from different users
    //Route::get ( '/', 'HomeController@Index')->name('pages.index');

    // CREATE
    Route::get ( '/create','QuoteController@create')->name('quotes.create');
    Route::post ( '/new','QuoteController@new')->name('quotes.new');
    Route::post ('/save', 'QuoteController@save')->name('quotes.save');
    // READ
    Route::get ( '/','QuoteController@home')->name('quotes.home');
    Route::post ( '/search','QuoteController@search')->name('quotes.search');
    // UPDATE
    Route::post ('/edit', 'QuoteController@edit')->name('quotes.edit');
    Route::put ('/save/{posterId?}', 'QuoteController@save')->name('quotes.save');
    // DELETE
    Route::delete ('/delete/{posterId}', 'QuoteController@delete')->name('quotes.delete');

