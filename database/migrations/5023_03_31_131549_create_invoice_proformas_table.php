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
        Schema::create('invoice_proformas', function (Blueprint $table) {
            $table->id();
            $table->string('inv_num')->nullable();
            $table->unsignedBigInteger('financial_year_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('period');
            $table->boolean('status_director')->default(0);
            //date for signing iki expire change to over due for directore
            $table->date('status_date')->nullable();
            $table->boolean('status_co')->default(0);
            //date for signing iki expire change to over due
            $table->date('status_co_date')->nullable(); 
            $table->boolean('delivery_status')->default(0);
            $table->date('delivery_status_date')->nullable();
            $table->string('payment_status')->default('Pending Payment'); //Pending Payment or Paid
            $table->string('lpo')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('approved_for_supply');
            $table->foreign('financial_year_id')->references('id')->on('financial_years');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
         
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
        Schema::dropIfExists('invoice_proformas');
    }
};
