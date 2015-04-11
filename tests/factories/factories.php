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