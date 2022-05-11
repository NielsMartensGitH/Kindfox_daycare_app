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
        Schema::create('main_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('email',255);
            $table->string('password',255);
            $table->string('street_number',255);
            $table->string('country',255);
            $table->string('postal_code',255);
            $table->string('city');
            $table->string('phone_number',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_u_sers');
    }
};
