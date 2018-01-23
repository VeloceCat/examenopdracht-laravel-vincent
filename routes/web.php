<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');

    Route::name('create_post_path')->get('/posts/create', 'PostsController@create');

    Route::name('store_post_path')->post('/posts', 'PostsController@store');

    Route::name('edit_post_path')->get('/posts/{post}/edit', 'PostsController@edit');

    Route::name('update_post_path')->put('/posts/{post}', 'PostsController@update');

    Route::name('delete_post_path')->delete('/posts/{post}', 'PostsController@delete');


    Route::name('create_comment_path')->get('/comments/{post_id}/create', 'CommentsController@create');

    Route::name('store_comment_path')->post('/comments/{post_id}', 'CommentsController@store');

    Route::name('edit_comment_path')->get('/comments/{id}/edit', 'CommentsController@edit');

    Route::name('update_comment_path')->put('/comments/{id}', 'CommentsController@update');

    Route::name('delete_comment_path')->delete('/comments/{comment}', "CommentsController@delete");


    Route::name('vote_up_path')->post('/votes/{post_id}/up', 'VotesController@voteup');

    Route::name('vote_down_path')->post('/votes/{post_id}/down', 'VotesController@votedown');
});

Route::get('/', 'PostsController@index'); 

Route::name('posts_path')->get('/posts', 'PostsController@index');

Route::name('post_path')->get('/posts/{post}', 'PostsController@show');