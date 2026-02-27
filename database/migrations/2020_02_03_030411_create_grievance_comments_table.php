<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrievanceCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grievance_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('grievance_id');
            $table->text('comment');
            $table->foreign('grievance_id')->references('id')->on('employee_grievances')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('grievance_comments');
    }
}
