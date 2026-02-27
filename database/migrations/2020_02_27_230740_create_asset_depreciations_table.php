<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetDepreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_depreciations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('asset_id');
            $table->date('depreciate_period');
            $table->decimal('depreciate_value',50,2);
            $table->foreign('asset_id')->references('id')->on('asset_managements')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('asset_depreciations');
    }
}
