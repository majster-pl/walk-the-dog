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
            $table->string('title')->nullable();
            $table->string('main_image_path')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('address_state_or_region')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_postcode_or_zip')->nullable();
            $table->string('address_country')->nullable();
            $table->string('address_latitude')->nullable();
            $table->double('walk_time', 2)->nullable();
            $table->boolean('parking')->nullable();
            $table->text('parking_details')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->integer('activity')->nullable();
            $table->text('description')->nullable();
            $table->boolean('dogs_only')->nullable();
            $table->boolean('seasonal_access')->nullable();
            $table->text('seasonal_details')->nullable();
            $table->boolean('off_lead')->nullable();
            $table->boolean('cafe_access')->nullable();
            $table->boolean('access_to_water')->nullable();
            $table->boolean('disposal_bins')->nullable();
            $table->string('status');

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
