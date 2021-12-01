<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenity_post', function (Blueprint $table) {
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_amenity');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->primary(['id_post', 'id_amenity']);
            $table->foreign('id_post')->references('id')->on('posts');
            $table->foreign('id_amenity')->references('id')->on('amenities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenity_post');
    }
}
