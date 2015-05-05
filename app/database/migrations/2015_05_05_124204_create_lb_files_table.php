<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_files', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('issue_id')->unsigned();
			$table->integer('comment_id')->unsigned()->nullable();
			$table->string('filename');
			$table->string('file_title');
			$table->string('file_size', 100);
			$table->string('salt');
			$table->integer('creator')->unsigned();
			$table->integer('uploaded')->unsigned();
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
		Schema::drop('lb_files');
	}

}
