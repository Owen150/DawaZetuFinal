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
        Schema::create('county_pharmacists', function (Blueprint $table) {
            $table->id();
            $table->string('requested_by');
            $table->string('request_date');
            $table->string('facility_id');
            $table->string('request_id')->unique();
            $table->string('processed_by');
            $table->string('status');
            $table->string('comments');
            
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
        Schema::dropIfExists('county_pharmacists');
    }
};
