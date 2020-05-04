<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeductiondefinationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deductiondefinations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('deductionname', 200)->nullable();
			$table->string('deductionpercentage', 200)->nullable();
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
		Schema::drop('deductiondefinations');
	}

}
