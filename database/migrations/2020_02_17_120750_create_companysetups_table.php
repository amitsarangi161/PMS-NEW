<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companysetups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyname', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('websitelink', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('gst', 100)->nullable();
            $table->string('pan', 100)->nullable();
            $table->string('tinno', 100)->nullable();
            $table->string('tanno', 100)->nullable();
            $table->string('servicetaxno', 100)->nullable();
            $table->string('exciseno', 100)->nullable();
            $table->string('logo', 500)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('companysetups');
    }
}
