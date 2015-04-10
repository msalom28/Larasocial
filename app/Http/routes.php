<?php

/**
 * Registration
 */
Route::get('/', ['as' => 'registration_path', 'uses' => 'RegistrationController@create']);

Route::post('/', ['as' => 'registration_path', 'uses' => 'RegistrationController@store']);