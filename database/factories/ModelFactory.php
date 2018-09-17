<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */



$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname'  => $faker->lastName,
        'email'     => $faker->email,
        'password'  => bcrypt('password'),
        'gender'	=> 'M',
        'birthday'	=> '12-06-1980',
        'profileimage' => '/images/noavatar.png'
    ];
});
$factory->define(App\Feed::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function(){
                    return factory(\App\User::class)->create()->id;
        },
        'body' => $faker->sentence,
        'poster_firstname'  => $faker->firstName,
        'poster_profile_image'  => $faker->imageUrl($width = 180, $height = 180)
    ];
});
$factory->define(App\FriendRequest::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'requester_id'  => $faker->numberBetween($min = 2, $max = 30)
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        'body'  => $faker->sentence,
        'senderid' => $faker->randomDigit,
        'sendername' => $faker->name,
        'senderprofileimage' => $faker->imageUrl($width = 180, $height = 180)
    ];
});
$factory->define(App\MessageResponse::class, function (Faker\Generator $faker) {
    return [
        'message_id' => function(){
            return factory(\App\Message::class)->create()->id;
        },
        'body'  => $faker->sentence,
        'senderid' => $faker->randomDigit,
        'receiverid' => $faker->randomDigit,
        'sendername' => $faker->name,
        'senderprofileimage' => $faker->imageUrl($width = 180, $height = 180)
    ];
});
