<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('clientid', 200)->nullable();
			$table->string('clientname', 200)->nullable();
			$table->string('district_id', 200)->nullable();
			$table->string('division_id', 200)->nullable();
			$table->string('projectname', 500)->nullable();
			$table->string('projectid', 100)->nullable();
			$table->date('startdate')->nullable();
			$table->date('enddate')->nullable();
			$table->string('cost', 200)->nullable();
			$table->string('priority', 200)->nullable();
			$table->string('status', 200)->nullable()->default('ASSIGNED');
			$table->string('orderform', 500)->nullable();
			$table->string('loano', 300)->nullable();
			$table->string('agreementno', 300)->nullable();
			$table->date('isddate')->nullable();
			$table->string('isdamount', 100)->nullable();
			$table->string('isdvalidupto', 100)->nullable();
			$table->string('isdattachment', 100)->nullable();
			$table->date('emddate')->nullable();
			$table->string('emdamount', 100)->nullable();
			$table->string('emdvalidupto', 100)->nullable();
			$table->string('emdattachment', 100)->nullable();
			$table->date('apsdate')->nullable();
			$table->string('apsamount', 100)->nullable();
			$table->string('apsvalidupto', 100)->nullable();
			$table->string('apsattachment', 100)->nullable();
			$table->date('bgdate')->nullable();
			$table->string('bgamount', 100)->nullable();
			$table->string('bgvalidupto', 100)->nullable();
			$table->string('bgattachment', 100)->nullable();
			$table->date('dddate')->nullable();
			$table->string('ddamount', 100)->nullable();
			$table->string('ddvalidupto', 100)->nullable();
			$table->string('ddattachment', 100)->nullable();
			$table->string('papercost', 100)->nullable();
			$table->string('papercostattachment', 100)->nullable();
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
		Schema::drop('projects');
	}

}
