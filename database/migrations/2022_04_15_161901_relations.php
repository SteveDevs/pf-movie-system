<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theaters', function (Blueprint $table) {
            //Non cascade to keep records if cinema closes
            $table->foreign('cinema_id')->references('id')->on('cinemas');
        });
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->foreign('movie_play_id')->references('id')->on('movie_plays');
        });
        Schema::table('movie_plays', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
        });
        Schema::table('booking_movie_users', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('movie_bookings');
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
        Schema::table('theaters', function (Blueprint $table) {
            $table->dropForeign('theaters_cinema_id_foreign');
            $table->dropColumn('cinema_id');

        });
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->dropForeign('movie_bookings_movie_play_id_foreign');
            $table->dropColumn('movie_play_id');
        });
        Schema::table('movie_plays', function (Blueprint $table) {
            $table->dropForeign('movie_plays_movie_id_foreign');
            $table->dropColumn('movie_id');
        });
        Schema::table('booking_movie_users', function (Blueprint $table) {
            $table->dropForeign('booking_movie_users_booking_id_foreign');
            $table->dropForeign('booking_movie_users_user_id_foreign');
            $table->dropColumn('booking_id');
            $table->dropColumn('user_id');
        });
    }
}
