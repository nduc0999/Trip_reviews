<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth')->nullable();
            $table->text('introduce')->nullable();
            $table->string('img_avatar')->nullable();
            $table->string('img_wall')->nullable();
            $table->string('phone', 15)->nullable()->unique();
            $table->string('country', 100)->nullable();
            $table->integer('role')->default(0);
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('introduce');
            $table->dropColumn('img_avatar');
            $table->dropColumn('img_wall');
            $table->dropColumn('phone');
            $table->dropColumn('country');
            $table->dropColumn('role');
            $table->dropColumn('status');
        });
    }
}
