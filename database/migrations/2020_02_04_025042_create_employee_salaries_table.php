<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('payroll_period');
            $table->string('employee_no');
            $table->decimal('nett_salary',50,2);
            $table->decimal('jkk',50,2);
            $table->decimal('jkm',50,2);
            $table->decimal('leave_balance',50,2);
            $table->decimal('rewards',50,2);
            $table->decimal('expense',50,2);
            $table->decimal('bpjs',50,2);
            $table->decimal('jht',50,2);
            $table->decimal('jp',50,2);
            $table->decimal('income_tax',50,2);
            $table->decimal('receive_payroll',50,2);
            $table->uuid('created_by');
            $table->uuid('approved_by')->nullable();
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
        Schema::dropIfExists('employee_salaries');
    }
}
