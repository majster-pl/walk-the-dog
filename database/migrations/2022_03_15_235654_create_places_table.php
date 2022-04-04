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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->castrained()->onDelete('cascade');
            $table->string('address_line1')->required();
            $table->string('address_line2')->nullable();
            $table->string('address_state_or_region')->required();
            $table->string('address_city')->required();
            $table->string('address_postcode_or_zip')->nullable();
            $table->string('address_country')->required();
            $table->string('address_latitude')->required();
            $table->double('walk_time', 2)->required();
            $table->boolean('parking')->nullable();
            // $table->boolean('parking_fee');
            $table->text('parking_details')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->integer('popularity')->nullable();
            $table->text('description')->required();


            $table->boolean('seasonal_access')->nullable();
            $table->text('seasonal_details')->nullable();
            $table->boolean('access_to_water')->nullable();
            $table->boolean('off_leach')->nullable();
            $table->boolean('disposal')->nullable();
            $table->boolean('coffe_access')->nullable();
            $table->timestamps();
            
            $table->foreign('type_id')->references('id')->on('place_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
};
