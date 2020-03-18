<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            // name, description, floor area size, price per month, number of rooms, valid geolocation coordinates, date added and an associated realtor
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('floor_area_size');
            $table->string('price_per_month');
            $table->integer('number_of_rooms');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('realtor_id');
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
        Schema::dropIfExists('apartments');
    }
}
