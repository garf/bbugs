<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone', 50)->nullable();
			$table->string('skype', 200)->nullable();
			$table->string('password');
			$table->integer('recover_time');
			$table->rememberToken();
			$table->integer('reg_date');
			$table->integer('last_access');
			$table->string('last_ip', 80)->nullable();
			$table->date('updated_at');
			$table->enum('status', array('1','0','2'))->default('1')->index('_status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lb_users');
	}

}
