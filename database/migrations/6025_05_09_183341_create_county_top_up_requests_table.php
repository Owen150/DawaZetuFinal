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
        Schema::create('county_top_up_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_product_id');
            $table->foreign('facility_product_id')->references('id')->on('facility_products');
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
        Schema::dropIfExists('county_top_up_requests');
    }
};
