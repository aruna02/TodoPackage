<?php

Route::group(['namespace' => '\Spices\TodoApp\Controllers'], function () {
    Route::get('test', 'TodoController@test');
});
