<?php



Route::get('profile/{user?}', 'ProfileController@show')->name('profile.show');
Route::post('profile', 'ProfileController@update')->name('profile.update');

Route::get('/community', 'CommunityController@index')->name('community.index');

Route::get('/rounds', 'RoundController@index')->name('rounds.index');
Route::post('round/ideas/{idea}', 'IdeaController@store')->name('ideas.store');
Route::post('attachments/{idea}', 'AttachmentController@store')->name('attachments.store');


Route::get('/users/search', 'UserController@show')->name('users.search');

Route::get('/friends', 'FriendController@index')->name('friends.index');
Route::post('/friends/{user}', 'FriendController@store')->name('friends.store');
Route::delete('/friends/{user}', 'FriendController@destroy')->name('friends.destroy');

Route::delete('/friend-request/{friendRequest}', 'FriendRequestController@destroy')->name('friendRequest.destroy');
Route::post('/friend-request/{user}', 'FriendRequestController@store')->name('friendRequest.store');

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


