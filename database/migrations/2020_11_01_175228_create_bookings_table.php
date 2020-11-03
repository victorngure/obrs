<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->string('ticket_number');
            $table->string('full_name');
            $table->string('id_number');
            $table->string('phone_number');
            $table->string('email');            
            $table->timestamps();
        });

        Schema::table('bookings', function($table) {
            $table->foreign('trip_id')->references('id')->on('trips');
            $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
