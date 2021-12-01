<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_postphoto');
            $table->string('path');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('id_post')->references('id')->on('posts');
            $table->foreign('id_postphoto')->references('id')->on('post_photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_users');
    }
}
