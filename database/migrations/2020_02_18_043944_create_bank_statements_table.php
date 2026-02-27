<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('bank_account_id');
            $table->date('transaction_date');
            $table->string('account_name')->nullable();
            $table->string('payee');
            $table->string('description')->nullable();
            $table->decimal('amount',50,2);
            $table->uuid('status_id');
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bank_statements');
    }
}
