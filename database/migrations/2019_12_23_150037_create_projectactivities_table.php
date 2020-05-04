<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectactivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projectactivities', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('projectid', 200);
			$table->string('activityid', 200);
			$table->string('position', 100);
			$table->date('startdate');
			$table->date('enddate');
			$table->string('duration', 100);
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
		Schema::drop('projectactivities');
	}

}
