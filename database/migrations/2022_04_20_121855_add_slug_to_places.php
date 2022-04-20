<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('places', 'slug')) {
            Schema::table('places', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};
