<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MessageResponseUserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$date = new DateTime();

		$messageResponseIds = DB::table('message_responses')->lists('id');

		foreach ($messageResponseIds as $messageResponseId) {
			
			DB::insert('insert into message_response_user (message_response_id, user_id, created_at, updated_at) values (?, ?, ?, ?)', [
				$messageResponseId, 1, $date->format('Y-m-d H:i:s'), $date->format('Y-m-d H:i:s')]);
		}

		
	}
}
