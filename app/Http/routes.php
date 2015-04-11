<?php

/**
 * Registration
 */
Route::get('/', ['as' => 'registration_path', 'uses' => 'RegistrationController@create']);

Route::post('/', ['as' => 'registration_path', 'uses' => 'RegistrationController@store']);

/**
 * Session
 */
Route::post('login', ['as' => 'login_path', 'uses' => 'SessionController@store']);

Route::get('logout', ['as' => 'logout_path', 'uses' => 'SessionController@destroy']);

Route::delete('logout', ['as' => 'logout_path', 'uses' => 'SessionController@destroy']);


/**
 * Feeds
 */
Route::get('feeds', ['as' => 'feeds_path', 'uses' => 'FeedController@index']);

