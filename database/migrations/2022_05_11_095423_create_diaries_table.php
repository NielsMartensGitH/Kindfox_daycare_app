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
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('food_message');
            $table->boolean('food_smile');
            $table->text('sleep_message');
            $table->boolean('sleep_smile');
            $table->integer('poop_icons');
            $table->string('mood',255);
            $table->text('activity_message');
            $table->text('involvement_message');
            $table->text('extra_message');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('company_id')->references('id')->on('companies')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diaries');
    }
};
