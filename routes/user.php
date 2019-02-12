<?php


Route::get('/profile/{user?}', 'ProfileController@show')->name('profile.show');
Route::post('profile', 'ProfileController@update')->name('profile.update');


Route::get('/posts', 'PostsController@index');
Route::post('/posts' , 'PostsController@store');
Route::get('/posts/create' , 'PostsController@showNewPost');
Route::delete('/posts', 'PostsController@delete');
Route::get('/posts/edit/{post}' , 'PostsController@update');
Route::post('/posts/edit/{post}', 'PostsController@edit');
Route::get('/posts/{category}' , 'PostsController@indexToCat');
Route::get('/posts/tag/{tag}'   , 'PostsController@getTagPosts');

Route::get('/posts/index/{post}' , 'PostsController@indexToPost');


Route::post('/comments'       , 'CommentController@store');
Route::delete('/comments', 'CommentController@delete');
Route::put('/commentsupdate', 'CommentController@update_comm');

Route::post('/replys'       , 'ReplysController@store');
Route::delete('/replys/delete'       , 'ReplysController@delete');
Route::put('/replys/update'       , 'ReplysController@update');

Route::get('/categories' , 'CategoriesController@show');
Route::post('/categories', 'CategoriesController@store');

