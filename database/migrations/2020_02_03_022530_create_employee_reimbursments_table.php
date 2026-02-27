<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeReimbursmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_reimbursments', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('employee_id');
            $table->date('transaction_date')->nullable();
            $table->integer('type_id');
            $table->decimal('amount',50,2);
            $table->string('notes');
            $table->uuid('status_id');
            $table->string('files')->nullable();
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
        Schema::dropIfExists('employee_reimbursments');
    }
}
