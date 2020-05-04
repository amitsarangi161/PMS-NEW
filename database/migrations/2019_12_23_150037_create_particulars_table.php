<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParticularsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('particulars', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('expenseheadid', 200)->nullable();
			$table->string('particularname', 200)->nullable();
			$table->string('userid', 100)->nullable();
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
		Schema::drop('particulars');
	}

}
