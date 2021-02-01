<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMspgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mspgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Company')->nullable();
            $table->string('Branch')->nullable();
            $table->string('Handling_branch')->nullable();
            $table->string('Store_name')->nullable();
            $table->string('Brand')->nullable();
            $table->string('Serial')->nullable();
            $table->string('Status')->nullable();
            $table->string('Start')->nullable();
            $table->string('End')->nullable();
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
        Schema::dropIfExists('mspgs');
    }
}
