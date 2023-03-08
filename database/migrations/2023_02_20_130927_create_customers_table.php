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
        Schema::dropIfExists('customers');
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('houseNumberOrName');
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('townCity');
            $table->string('postCode');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('emergencyName');
            $table->string('emergencyNumber');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
