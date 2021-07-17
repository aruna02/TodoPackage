<?php

Route::group(['namespace' => '\Spices\TodoApp\Controllers', 'middleware' => 'web'], function () {
    Route::get('test', 'TodoController@test');
    Route::get('/todos', 'TodoController@todos')->name('home');
    Route::get('/todo/{id}', 'TodoController@index')->name('todos');
    Route::post('/todo/add', 'TodoController@add')->name('savetodo');
    Route::post('/todo/update', 'TodoController@updateTodo')->name('update');
    Route::post('/todo/delete', 'TodoController@delete')->name('delete');
    Route::get('/todo/search/{name}', 'TodoController@searchByName')->name('search');
});
