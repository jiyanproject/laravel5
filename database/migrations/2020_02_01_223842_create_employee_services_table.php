<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('employee_id');
            $table->string('position');
            $table->string('report_to');
            $table->string('grade');
            $table->date('from');
            $table->date('to')->nullable();
            $table->decimal('salary',50,2);
            $table->string('contract')->nullable();
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
        Schema::dropIfExists('employee_services');
    }
}
