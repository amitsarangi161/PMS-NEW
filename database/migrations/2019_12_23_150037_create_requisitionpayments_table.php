<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequisitionpaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requisitionpayments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('rid', 200)->nullable();
			$table->string('amount', 200)->nullable();
			$table->string('paymenttype', 200)->nullable();
			$table->string('remarks', 200)->nullable();
			$table->string('bankid', 200)->nullable();
			$table->string('paymentstatus', 200)->nullable()->default('PENDING');
			$table->string('transactionid', 200)->nullable();
			$table->date('dateofpayment')->nullable();
			$table->string('vendorid', 200)->nullable();
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
		Schema::drop('requisitionpayments');
	}

}
