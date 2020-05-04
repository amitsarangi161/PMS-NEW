<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequisitionheadersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requisitionheaders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('employeeid')->nullable();
			$table->string('projectid', 200)->nullable();
			$table->string('userid', 200)->nullable();
			$table->string('totalamount', 500)->nullable();
			$table->string('approvalamount', 200)->nullable()->default('0');
			$table->string('status', 200)->nullable()->default('PENDING MGR');
			$table->string('approvedby', 200)->nullable();
			$table->string('remarks', 200)->nullable();
			$table->string('cancelledby', 200)->nullable();
			$table->string('cancelreason', 200)->nullable();
			$table->string('description', 2000)->nullable();
			$table->date('datefrom')->nullable();
			$table->date('dateto')->nullable();
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
		Schema::drop('requisitionheaders');
	}

}
