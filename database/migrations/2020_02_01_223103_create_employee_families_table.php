<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('employee_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('relations');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('employee_families');
    }
}
