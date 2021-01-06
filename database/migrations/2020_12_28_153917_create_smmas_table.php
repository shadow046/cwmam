<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smmas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Company')->nullable();
            $table->string('Location')->nullable();
            $table->string('Handling_branch')->nullable();
            $table->string('Model')->nullable();
            $table->string('Serial')->nullable();
            $table->string('Start')->nullable();
            $table->string('End')->nullable();
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
        Schema::dropIfExists('smmas');
    }
}
