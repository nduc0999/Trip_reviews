<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_travel', function (Blueprint $table) {
            $table->unsignedBigInteger('id_travel');
            $table->unsignedBigInteger('id_post');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->primary(['id_post', 'id_travel']);
            $table->foreign('id_post')->references('id')->on('posts');
            $table->foreign('id_travel')->references('id')->on('travel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_travel');
    }
}
