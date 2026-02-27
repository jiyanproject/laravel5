<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('employee_id');
            $table->string('training_provider');
            $table->string('training_title');
            $table->string('location');
            $table->date('from');
            $table->date('to')->nullable();
            $table->uuid('status');
            $table->string('certification')->nullable();
            $table->string('reports')->nullable();
            $table->string('materials')->nullable();
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
        Schema::dropIfExists('employee_trainings');
    }
}
