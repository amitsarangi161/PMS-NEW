<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTodosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('todos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 200)->nullable();
			$table->text('description', 65535)->nullable();
			$table->date('date')->nullable();
			$table->time('time')->nullable();
			$table->dateTime('datetime')->nullable();
			$table->string('status', 200)->default('1');
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
		Schema::drop('todos');
	}

}
