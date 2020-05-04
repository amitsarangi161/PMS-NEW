<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payeename', 500)->nullable();
            $table->string('projectid', 200)->nullable();
            $table->string('expenseheadid', 200)->nullable();
            $table->string('particularid', 200)->nullable();
             $table->date('date')->nullable();
            $table->string('amount', 200)->nullable();
             $table->string('paymenttype', 200)->nullable();
             $table->text('paymentdetails', 65535)->nullable();
             $table->text('description', 65535)->nullable();
            $table->string('uploadedfile', 200)->nullable();  
             $table->string('status', 200)->nullable()->default('PENDING');
            $table->string('author', 200)->nullable();
            $table->string('approvedby', 200)->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}
