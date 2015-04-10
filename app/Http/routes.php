<?php

/**
 * Registration
 */
Route::get('/', ['as' => 'registration_path', 'uses' => 'RegistrationController@create']);