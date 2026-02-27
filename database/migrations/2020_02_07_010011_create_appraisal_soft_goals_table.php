<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalSoftGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_soft_goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('appraisal_id');
            $table->string('competency');
            $table->text('notes');
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
        Schema::dropIfExists('appraisal_soft_goals');
    }
}
