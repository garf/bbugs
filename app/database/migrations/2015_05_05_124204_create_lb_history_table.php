<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('to_id')->nullable();
			$table->integer('project_id')->unsigned();
			$table->integer('issue_id')->unsigned()->nullable();
			$table->integer('comment_id')->nullable();
			$table->enum('act_type', array('new_issue','new_file','new_comment','issue_update','issue_edit'));
			$table->integer('act_time')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lb_history');
	}

}
