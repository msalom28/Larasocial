<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\User;

class DatabaseSeeder extends Seeder {

	protected $tables = ['users'];
	protected $seeders = ['UserTableSeeder'];
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
		// DB::statement('SET FOREIGN_KEY_CHECKS=0');

		foreach ($this->tables as $table) {
			
			DB::table($table)->truncate();
		}
		
		// DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
	
}