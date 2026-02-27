<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('attendance_id');
            $table->datetime('clock_in');
            $table->datetime('clock_out')->nullable();
            $table->string('notes');
            $table->foreign('attendance_id')->references('id')->on('employee_attendances')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('attendance_transactions');
    }
}
