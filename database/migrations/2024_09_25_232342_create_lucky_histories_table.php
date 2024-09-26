<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuckyHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('lucky_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->integer('random_number');
            $table->string('result');
            $table->integer('win_amount');
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('player')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lucky_histories');
    }
}
