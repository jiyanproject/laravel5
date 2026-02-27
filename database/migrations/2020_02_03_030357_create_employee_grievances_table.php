<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeGrievancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_grievances', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('employee_id');
            $table->string('subject');
            $table->integer('type_id');
            $table->boolean('is_public');
            $table->text('description');
            $table->string('files')->nullable();
            $table->uuid('status_id');
            $table->integer('rating')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->primary('id');
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
        Schema::dropIfExists('employee_grievances');
    }
}
