<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->float('rate', 3, 2);
            $table->string('title', 150);
            $table->date('trip_when');
            $table->string('trip_type');
            $table->float('rate_service', 3, 2);
            $table->float('rate_value', 3, 2);
            $table->float('rate_sleep', 3, 2);
            $table->text('rep')->nullable();
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_user');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('id_post')->references('id')->on('posts');
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
        Schema::dropIfExists('reviews');
    }
}
