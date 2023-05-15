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
        Schema::create('unavailable_products', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(0); //has be added to the next order for the next supplier in rank
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('facility_id');
            $table->unsignedBigInteger('supplier_id');
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
        Schema::dropIfExists('unavailable_products');
    }
};
