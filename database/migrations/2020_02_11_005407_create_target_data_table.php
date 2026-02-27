<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('target_id')->unsigned();
            $table->uuid('appraisal_id');
            $table->text('data_details');
            $table->string('file')->nullable();
            $table->foreign('target_id')->references('id')->on('appraisal_targets')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('target_data');
    }
}
