<?php 

$factory('App\User', [

	'firstname' => $faker->firstName,
	'lastname'  => $faker->lastName,
	'email'     => $faker->email,
	'password'  => 'password',
	'gender'	=> 'M',
	'birthday'	=> '12-06-1980',
	'profileimage' => $faker->imageUrl($width = 180, $height = 180)

]);

$factory('App\Feed', [
	'user_id' => 'factory:App\User',
	'body' => $faker->sentence,
	'poster_firstname'  => $faker->firstName,
	'poster_profile_image'  => $faker->imageUrl($width = 180, $height = 180)
]);