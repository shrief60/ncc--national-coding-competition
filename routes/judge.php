<?php



    Route::get('/rounds/create', 'RoundController@create');
    Route::post('/rounds/create', 'RoundController@store')->name('rounds.create');

    Route::get('/rounds/edit', 'RoundController@edit');
    Route::post('/rounds/edit/{round}', 'RoundController@update')->name('rounds.edit');


    Route::get('/progress/index', 'ProgressController@index');

    Route::get('/progress/show/{sub}', 'ProgressController@show');
    Route::get('/dashboard', 'DashboardController@index');


    //Route::post('/rounds/edit/{round}', 'RoundController@update')->name('rounds.edit');
