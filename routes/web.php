<?php
        // I will add the home page once we have DB setup so I display any
        // previously created poster from different users
    //Route::get ( '/', 'HomeController@Index')->name('pages.index');
        // The /quotes endpoint will the user profile
    Route::get ( '/','QuoteController@home')->name('quotes.home');
    Route::get ( '/create','QuoteController@create')->name('quotes.create');
    Route::post ( '/new','QuoteController@new')->name('quotes.new');
    Route::post ( '/search','QuoteController@search')->name('quotes.search');
    Route::post ('/save', 'QuoteController@save')->name('quotes.save');
    Route::put ('/save/{posterId?}', 'QuoteController@save')->name('quotes.save');
    Route::post ('/edit', 'QuoteController@edit')->name('quotes.edit');
    Route::delete ('/delete/{posterId}', 'QuoteController@delete')->name('quotes.delete');

    Route::get('/debug', function () {

        $debug = [
            'Environment' => App::environment(),
        ];

        /*
        The following commented out line will print your MySQL credentials.
        Uncomment this line only if you're facing difficulties connecting to the
        database and you need to confirm your credentials. When you're done
        debugging, comment it back out so you don't accidentally leave it
        running on your production server, making your credentials public.
        */
        #$debug['MySQL connection config'] = config('database.connections.mysql');

        try {
            $databases = DB::select('SHOW DATABASES;');
            $debug['Database connection test'] = 'PASSED';
            $debug['Databases'] = array_column($databases, 'Database');
        } catch (Exception $e) {
            $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
        }

        dump($debug);
    });
