<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('data_id')->unsigned();
            $table->string('target');
            $table->integer('job_weight');
            $table->foreign('data_id')->references('id')->on('appraisal_data')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('appraisal_targets');
    }
}
