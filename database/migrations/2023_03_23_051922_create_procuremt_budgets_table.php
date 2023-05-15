<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * this table is resposible for storing budget received from finance department
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procuremt_budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financial_year_id');
            $table->bigInteger('amount');
            $table->date('date_received');
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
        Schema::dropIfExists('procuremt_budgets');
    }
};
