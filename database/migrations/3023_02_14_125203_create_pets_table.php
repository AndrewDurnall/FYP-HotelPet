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
        // drop the pets table if it exists
        Schema::dropIfExists('pets');

        // create a table called pets with columns as follows
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('petName');
            $table->integer('petAge')->nullable();
            $table->string('species');
            $table->string('breed');
            $table->string('vetName');
            $table->string('vetNumber');
            $table->string('microChip')->default('No Microchip / Unknown Number')->nullable();
            $table->date('vaccinationDate');
            $table->string('feedingRequirements')->default('None')->nullable();
            $table->string('avoidedFood')->default('None')->nullable();
            $table->string('medicationDetails')->default('No Medication')->nullable();
            $table->dateTime('updated_at');
            $table->dateTime('created_at');

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
        Schema::dropIfExists('pets');
    }
};
