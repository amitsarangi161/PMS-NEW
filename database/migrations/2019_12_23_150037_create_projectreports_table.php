<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectreportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projectreports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('reportfordate')->nullable();
			$table->string('clientid', 100)->nullable();
			$table->string('projectid', 100)->nullable();
			$table->string('activityid', 100)->nullable();
			$table->string('subject', 500)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('userid', 100)->nullable();
			$table->string('author', 100)->nullable();
			$table->string('status', 200)->nullable()->default('NOT VERIFIED');
			$table->string('acceptedby', 100)->nullable();
			$table->string('remark', 500)->nullable();
			$table->timestamps();
			$table->string('authorid', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projectreports');
	}

}
