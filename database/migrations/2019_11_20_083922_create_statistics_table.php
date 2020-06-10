<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('parfume_id');
            $table->unsignedBigInteger('value');
            $table->timestamps();

            $table->foreign('criteria_id')->references('id')->on('criterias');
            $table->foreign('parfume_id')->references('id')->on('parfumes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
