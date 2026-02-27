<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('budget_id');
            $table->string('account_name');
            $table->decimal('budget_amount',50,2);
            $table->foreign('budget_id')->references('id')->on('budget_periods')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('budget_details');
    }
}
