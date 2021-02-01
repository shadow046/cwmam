<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lccs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Customer_name')->nullable();
            $table->string('Item_description');
            $table->string('Serial')->nullable();
            $table->string('Receiving_date')->nullable();
            $table->string('End_warranty')->nullable();
            $table->string('Specifications')->nullable();
            $table->string('Status')->nullable();
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
        Schema::dropIfExists('lccs');
    }
}
