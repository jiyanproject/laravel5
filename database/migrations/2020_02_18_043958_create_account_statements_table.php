<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_statements', function (Blueprint $table) {
            $table->uuid('id');
            $table->date('transaction_date');
            $table->string('reference_no');
            $table->string('payee');
            $table->text('description');
            $table->uuid('status_id');
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
        Schema::dropIfExists('account_statements');
    }
}
