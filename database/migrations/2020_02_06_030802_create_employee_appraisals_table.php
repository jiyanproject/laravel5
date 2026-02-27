<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_appraisals', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('employee_id');
            $table->uuid('supervisor_id');
            $table->date('appraisal_period');
            $table->integer('progress');
            $table->uuid('status_id');
            $table->primary('id');
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
        Schema::dropIfExists('employee_appraisals');
    }
}
