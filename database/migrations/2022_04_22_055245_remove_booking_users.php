<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBookingUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('booking_movie_users')) {
            Schema::table('booking_movie_users', function (Blueprint $table) {
                $table->dropForeign('booking_movie_users_user_id_foreign');
                $table->dropForeign('booking_movie_users_booking_id_foreign');
            });
            Schema::drop('booking_movie_users');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
