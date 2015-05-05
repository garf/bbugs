<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbProjectUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_project_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->index('_project_id');
			$table->integer('user_id')->index('_user_id');
			$table->enum('role', array('teamlead','developer','observer'))->default('observer');
			$table->decimal('hour_cost', 12)->default(0.00);
			$table->index(['project_id','user_id'], '_project_id_user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lb_project_user');
	}

}
