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
            Schema::create('locations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('county_id');
                $table->unsignedBigInteger('subcounty_id');
                $table->unsignedBigInteger('ward_id');
                $table->string('location_name');

                $table->foreign('county_id')->references('id')->on('counties');
                $table->foreign('subcounty_id')->references('id')->on('subcounties');
                $table->foreign('ward_id')->references('id')->on('wards');
    
                $table->timestamps();
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
