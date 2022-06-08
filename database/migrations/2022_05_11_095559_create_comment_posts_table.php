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
        Schema::create('comment_posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('diary_id')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('comment_id')->references('id')->on('comments')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('diary_id')->references('id')->on('diaries')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_posts');
    }
};
