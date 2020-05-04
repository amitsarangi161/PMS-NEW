<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendances', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 200)->nullable();
			$table->string('latitude', 300)->nullable();
			$table->string('longitude', 300)->nullable();
			$table->string('present', 200)->nullable();
			$table->string('battery', 200)->nullable();
			$table->string('deviceid', 200)->nullable();
			$table->string('time', 200)->nullable();
			$table->string('mode', 200)->nullable();
			$table->string('status', 200)->nullable();
			$table->timestamps();
			$table->string('version', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendances');
	}

}
