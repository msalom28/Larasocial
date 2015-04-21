<?php

use Illuminate\Database\Seeder;
use App\MessageResponse;
use Faker\Factory as Faker;

class MessageResponsesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$messageIds = DB::table('messages')->lists('id');

		$messageSenderIds = DB::table('messages')->lists('senderid');


		foreach ($messageIds as $messageId) {
			
			MessageResponse::create([
				'body'		=> $faker->sentence,
				'message_id' => $messageId,
				'senderid' => $faker->randomElement($messageSenderIds),
				'receiverid' => 1,
				'sendername' => $faker->name,
				'senderprofileimage' => $faker->imageUrl($width = 180, $height = 180)
			]);
		}
		
	}
}