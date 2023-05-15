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
        if (!Schema::hasTable('wards')){
            Schema::create('wards', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('county_id');
                $table->unsignedBigInteger('subcounty_id');
                $table->unsignedBigInteger('location_id');
                $table->string('ward_name');
                $table->timestamps();
                
                $table->foreign('county_id')->references('id')->on('counties');
                $table->foreign('subcounty_id')->references('id')->on('subcounties');
                $table->foreign('location_id')->references('id')->on('locations');
            });
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wards');
    }
};
