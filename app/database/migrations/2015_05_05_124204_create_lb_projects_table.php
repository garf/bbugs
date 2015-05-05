<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_id')->default(0);
			$table->integer('creator')->unsigned();
			$table->string('title');
			$table->text('description', 65535);
			$table->decimal('budget', 12)->default(0.00);
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
		Schema::drop('lb_projects');
	}

}
