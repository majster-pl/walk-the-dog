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
        Schema::create('place_pictures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('place_id');
            $table->foreignId('creator_id');

            $table->timestamps();
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_pictures');
    }
};
