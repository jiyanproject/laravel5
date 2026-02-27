<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('leave_id');
            $table->integer('leave_type');
            $table->datetime('leave_start');
            $table->datetime('leave_end');
            $table->string('notes');
            $table->foreign('leave_id')->references('id')->on('employee_leaves')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('leave_transactions');
    }
}
