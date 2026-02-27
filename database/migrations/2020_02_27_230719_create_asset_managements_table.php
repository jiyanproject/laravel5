<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_managements', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('category_name');
            $table->date('purchase_date');
            $table->decimal('purchase_price',50,2);
            $table->integer('estimate_time');
            $table->decimal('estimate_depreciate_value',50,2);
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
        Schema::dropIfExists('asset_managements');
    }
}
