<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lb_issues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index('_project_id');
			$table->string('title');
			$table->text('content', 65535);
			$table->enum('status', array('new','opened','in_work','need_feedback','closed','not_actual','realized','rework'))->default('new')->index('_status');
			$table->enum('issue_type', array('task','bug','research'))->default('task');
			$table->integer('priority')->default(3);
			$table->decimal('hours_spent', 12)->default(0.00);
			$table->integer('creator');
			$table->integer('assigned')->unsigned()->nullable()->index('_assigned');
			$table->integer('created');
			$table->integer('updated');
			$table->date('updated_at');
			$table->index(['assigned','status'], '_assigned_status');
			$table->index(['status','project_id'], '_status_project_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lb_issues');
	}

}
