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

Route::delete('logout', ['as' => 'logout_path', 'uses' => 'SessionController@destroy']);


/**
 * Feeds
 */
Route::get('feeds', ['as' => 'feeds_path', 'uses' => 'FeedController@index']);

Route::post('feeds', ['as' => 'feeds_path', 'uses' => 'FeedController@store']);

Route::get('feeds/more', ['as' => 'feeds_path_more', 'uses' => 'FeedController@more']);

/**
 * Users
 */
Route::get('users', ['as' => 'users_path', 'uses' => 'UserController@index']);

Route::get('users/{id}', ['as' => 'user_profile_path', 'uses' => 'UserController@show']);

Route::post('users', ['as' => 'users_path', 'uses' => 'UserController@index']);

/**
 * Friend-requests
 */
Route::get('friend-requests', ['as' => 'friend_request_path', 'uses' => 'FriendRequestController@index']);

Route::post('friend-requests', ['as' => 'friend_request_path', 'uses' => 'FriendRequestController@store']);

Route::delete('friend-requests', ['as' => 'friend_request_path', 'uses' => 'FriendRequestController@destroy']);


/**
 * Friends
 */
Route::post('friends', ['as' => 'friends_path', 'uses' => 'FriendController@store']);

Route::get('friends', ['as' => 'friends_path', 'uses' => 'FriendController@index']);

Route::delete('friends', ['as' => 'friends_path', 'uses' => 'FriendController@destroy']);

/**
 * Messages
 */

Route::get('messages/{id}', ['as' => 'show_message_path', 'uses' => 'MessageController@show'])->where('id', '[0-9]+');

Route::get('messages', ['as' => 'message_path', 'uses' => 'MessageController@index']);

Route::post('messages', ['as' => 'save_message_path', 'uses' => 'MessageController@store']);

Route::get('messages/compose/{id}', ['as' => 'compose_message_path', 'uses' => 'MessageController@create']);

Route::delete('message-delete', ['as' => 'delete_message_path', 'uses' => 'MessageController@destroy']);

/**
 * MessageResponses
 */
Route::put('message-response', ['as' => 'message_responses_path', 'uses' => 'MessageResponseController@update']);

Route::post('message-response', ['as' => 'message_responses_path', 'uses' => 'MessageResponseController@store']);

/**
 * Chat Status
 */
Route::post('chatstatus', ['as' => 'chat_status_path', 'uses' => 'ChatStatusController@update']);

 /**
  * Chat Message
  */
 Route::post('chat', ['as' => 'conversation_path', 'uses' => 'ChatController@sendMessage']);


