<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeebankaccountsdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeebankaccountsdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id',22)->nullable();
            $table->string('accountholdername',50)->nullable();
            $table->string('accountnumber',50)->nullable();
            $table->string('bankname',50)->nullable();
            $table->string('ifsc',50)->nullable();
            $table->string('pan',50)->nullable();
            $table->string('branch',50)->nullable();
            $table->string('pfaccount',50)->nullable();
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
        Schema::dropIfExists('employeebankaccountsdetails');
    }
}
