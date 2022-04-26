<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToMovieBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('movie_play_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->dropForeign('movie_bookings_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
