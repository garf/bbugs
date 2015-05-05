<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('issue_id')->unsigned()->nullable();
			$table->text('comment', 65535);
			$table->integer('files_count')->default(0);
			$table->integer('creator')->unsigned();
			$table->integer('created')->unsigned();
			$table->date('updated_at');
			$table->enum('status', array('1','0'))->default('1');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lb_comments');
	}

}
