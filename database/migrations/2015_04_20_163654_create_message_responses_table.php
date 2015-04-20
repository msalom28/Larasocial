<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_responses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('body');
			$table->integer('message_id');
			$table->integer('senderid');
			$table->integer('receiverid');
			$table->string('sendername');
			$table->string('senderprofileimage');
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
		Schema::drop('message_responses');
	}

}
