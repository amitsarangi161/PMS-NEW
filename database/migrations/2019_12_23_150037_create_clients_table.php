<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clientname', 200)->nullable();
			$table->string('orgname', 500)->nullable();
			$table->string('contact1', 100)->nullable();
			$table->string('contact2', 100)->nullable();
			$table->string('officecontact', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('residentaddress', 200)->nullable();
			$table->string('officeaddress', 200)->nullable();
			$table->string('additionalinfo', 200)->nullable();
			$table->string('state', 200)->nullable();
			$table->string('country', 200)->nullable();
			$table->string('city', 200)->nullable();
			$table->string('dist', 200)->nullable();
			$table->string('userid', 100)->nullable();
			$table->string('gstn', 1000)->nullable();
			$table->string('panno', 200)->nullable();
			$table->string('tinno', 200)->nullable();
			$table->string('tanno', 200)->nullable();
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
		Schema::drop('clients');
	}

}
