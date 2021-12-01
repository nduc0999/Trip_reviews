<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('introduce');
            $table->string('address', 150);
            $table->string('streets', 70);
            $table->string('district', 70);
            $table->unsignedBigInteger('id_location');
            $table->string('link')->nullable();
            $table->string('open', 20);
            $table->string('closes', 20);
            $table->tinyInteger('min_guest');
            $table->tinyInteger('max_guest');
            $table->string('phone', 15);
            $table->decimal('latitude', 11, 8);
            $table->decimal('longtitude', 11, 8);
            $table->unsignedBigInteger('id_user');
            $table->string('img_avatar');
            $table->string('img_wall');
            $table->tinyInteger('owner');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();

            $table->foreign('id_location')->references('id')->on('locations');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
