<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpenseentriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expenseentries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('employeeid', 200)->nullable();
			$table->string('projectid', 200)->nullable();
			$table->string('expenseheadid', 200)->nullable();
			$table->string('particularid', 200)->nullable();
			$table->string('amount', 200)->nullable();
			$table->string('userid', 200)->nullable();
			$table->string('vendorid', 200)->nullable();
			$table->string('uploadedfile', 200)->nullable();
			$table->string('status', 200)->nullable()->default('HOD PENDING');
			$table->string('approvalamount', 200)->nullable()->default('0');
			$table->string('approvedby', 200)->nullable();
			$table->string('remarks', 200)->nullable();
			$table->string('vehicleid', 200)->nullable();
			$table->string('type', 200)->nullable();
			$table->text('description', 65535)->nullable();
			$table->date('fromdate')->nullable();
			$table->date('todate')->nullable();
			$table->date('date')->nullable();
			$table->string('towallet', 200)->default('NO');
			$table->string('version', 200)->default('OLD');
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
		Schema::drop('expenseentries');
	}

}
