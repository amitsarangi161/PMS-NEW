<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUseraccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('useraccounts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user', 200)->nullable();
			$table->string('bankid', 200)->nullable();
			$table->string('acno', 200)->nullable();
			$table->string('branchname', 500)->nullable();
			$table->string('ifsccode', 200)->nullable();
			$table->string('userid', 100)->nullable();
			$table->string('type', 200)->nullable();
			$table->string('forcompany', 200)->nullable();
			$table->string('scancopy', 1000)->nullable();
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
		Schema::drop('useraccounts');
	}

}
