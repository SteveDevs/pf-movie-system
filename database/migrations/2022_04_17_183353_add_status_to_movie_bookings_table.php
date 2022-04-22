<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMovieBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->unsignedTinyInteger('status_id')->after('unique_ref');
            $table->foreign('status_id')->references('id')->on('booking_statuses');
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
            $table->dropForeign('movie_bookings_status_id_foreign');
            $table->dropColumn('status_id');
        });
    }
}
