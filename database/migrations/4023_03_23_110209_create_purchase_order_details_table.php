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
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('code');
            $table->string('qty_ordered');
            $table->string('price')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('qty_received')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('total')->nullable();
            $table->string('feedback')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('purchase_orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_details');
    }
};
