<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('vendorname', 200)->nullable();
			$table->string('mobile', 200)->nullable();
			$table->string('email', 200)->nullable();
			$table->string('vendoridproof', 200)->nullable();
			$table->string('photo', 500)->nullable();
			$table->string('details', 5000)->nullable();
			$table->string('bankname', 200)->nullable();
			$table->string('acno', 200)->nullable();
			$table->string('tinno', 200)->nullable();
			$table->string('tanno', 200)->nullable();
			$table->string('panno', 200)->nullable();
			$table->string('gstno', 200)->nullable();
			$table->string('servicetaxno', 200)->nullable();
			$table->string('branchname', 200)->nullable();
			$table->string('ifsccode', 200)->nullable();
			$table->string('userid', 200)->nullable();
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
		Schema::drop('vendors');
	}

}
