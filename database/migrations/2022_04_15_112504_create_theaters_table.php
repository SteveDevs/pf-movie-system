<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theaters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cinema_id');
            $table->smallInteger('capacity')->default(30);//Can be used to set a standard size for theaters
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theaters');
    }
}
