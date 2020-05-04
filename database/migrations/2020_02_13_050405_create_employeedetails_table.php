<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeedetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeename',100)->nullable();
            $table->date('dob')->nullable();
            $table->string('email',100)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('alternativephonenumber',15)->nullable();
            $table->text('presentaddress');
            $table->text('permanentaddress');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeedetails');
    }
}
