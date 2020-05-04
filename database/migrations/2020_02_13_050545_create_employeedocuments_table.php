<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeedocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeedocuments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id',22)->nullable();
            $table->string('resume',1000)->nullable();
            $table->string('offerletter',1000)->nullable();
            $table->string('joiningletter',1000)->nullable();
            $table->string('agreementpaper',1000)->nullable();
            $table->string('idproof',1000)->nullable();
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
        Schema::dropIfExists('employeedocuments');
    }
}
