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
        Schema::create('consolidated_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_profoma_id');
            $table->unsignedBigInteger('purchase_order_id');
            $table->timestamps();

            $table->foreign('invoice_profoma_id')->references('id')->on('invoice_proformas');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidated_purchase_orders');
    }
};
