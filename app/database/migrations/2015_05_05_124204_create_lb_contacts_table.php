<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index('_user_id');
			$table->integer('contact_id')->index('_contact_id');
			$table->string('title');
			$table->boolean('is_email')->nullable()->default(0);
			$table->boolean('is_phone')->nullable()->default(0);
			$table->boolean('is_skype')->default(0);
			$table->string('notes');
			$table->integer('created')->unsigned();
			$table->index(['user_id','contact_id'], '_user_id_contact_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lb_contacts');
	}

}
