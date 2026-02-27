<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('appraisal_id');
            $table->integer('appraisal_type');
            $table->string('indicator');
            $table->text('target');
            $table->string('files');
            $table->foreign('appraisal_id')->references('id')->on('employee_appraisals')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('appraisal_data');
    }
}
