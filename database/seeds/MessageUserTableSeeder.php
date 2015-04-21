<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MessageUserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$date = new DateTime();

		$messageIds = DB::table('messages')->lists('id');

		foreach ($messageIds as $messageId) {
		
			DB::insert('insert into message_user (message_id, user_id, created_at, updated_at) values (?, ?, ?, ?)', [
				$messageId, 1, $date->format('Y-m-d H:i:s'), $date->format('Y-m-d H:i:s')]);
		}
	}
}