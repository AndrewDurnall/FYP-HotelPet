<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // drop the bookings table if it exists
        Schema::dropIfExists('bookings');

        // create a table called bookings with columns as follows
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pens_id');
            $table->unsignedBigInteger('customer_id');
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();

            //assigning the foreign key to the id of the pens table
            $table->foreign('pens_id')->references('id')->on('pens')->onDelete('cascade');

            //assigning the foreign key to the id of the customers table
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
};
