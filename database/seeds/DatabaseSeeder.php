<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\User;

class DatabaseSeeder extends Seeder {

	protected $tables = ['users', 'feeds', 'friend_requests'];
	protected $seeders = ['UserTableSeeder', 'FeedTableSeeder', 'FriendRequestTableSeeder'];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->cleanDatabase();

		foreach ($this->seeders as $seedClass) {
			
			$this->call($seedClass);
		}
	}
	/**
	 * Clean out the database for new seed generation
	 */
	public function cleanDatabase()
	{

		foreach ($this->tables as $table) {
			
			DB::table($table)->truncate();
		}
		
	}
	
}