<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumberTicketsMovieBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movie_bookings', function (Blueprint $table) {
            $table->smallInteger('no_tickets')->default(1)->after('status_id');
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
            $table->dropColumn('no_tickets');
        });
    }
}
