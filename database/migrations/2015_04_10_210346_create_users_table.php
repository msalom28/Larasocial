<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->char('gender', 1);
			$table->date('birthday');
			$table->string('profileimage');
			$table->boolean('onlinestatus')->default(0);
			$table->boolean('chatstatus')->default(1);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
