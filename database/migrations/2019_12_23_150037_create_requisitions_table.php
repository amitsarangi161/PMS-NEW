<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequisitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requisitions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('expenseheadid', 200)->nullable();
			$table->string('particularid', 500)->nullable();
			$table->string('description', 200)->nullable();
			$table->string('amount', 500)->nullable();
			$table->string('requisitionheaderid', 200)->nullable();
			$table->string('approvedamount', 200)->nullable()->default('0');
			$table->string('approvestatus', 200)->nullable()->default('PENDING');
			$table->string('cancelationreason', 200)->nullable();
			$table->string('remarks', 200)->nullable();
			$table->string('payto', 100)->nullable();
			$table->string('vendorid', 200)->nullable();
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
		Schema::drop('requisitions');
	}

}
