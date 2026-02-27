<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisalCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraisal_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('appraisal_id');
            $table->uuid('comment_by');
            $table->text('comments');
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
        Schema::dropIfExists('appraisal_comments');
    }
}
