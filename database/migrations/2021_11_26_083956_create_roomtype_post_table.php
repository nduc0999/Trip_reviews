<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomtypePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomtype_post', function (Blueprint $table) {
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_roomtype');
            $table->integer('count')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->primary(['id_post', 'id_roomtype']);
            $table->foreign('id_post')->references('id')->on('posts');
            $table->foreign('id_roomtype')->references('id')->on('roomtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roomtype_post');
    }
}
