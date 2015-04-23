<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
use App\FriendRequest;

class FriendRequestTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();

		$userIds = DB::table('users')->where('id', '!=', 1)->lists('id');


		foreach (range(1, 25) as $index) {	
			
				FriendRequest::create([
					'user_id'	=> 1,
					'requester_id' => $faker->randomElement($userIds)
				]);
			
			
		}
		
		
	}
}