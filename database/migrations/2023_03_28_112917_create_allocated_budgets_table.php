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
        Schema::create('allocated_budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finacial_year_id');
            $table->string('period');
            $table->string('budget');
            $table->timestamps();

            $table->foreign('finacial_year_id')->references('id')->on('financial_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocated_budgets');
    }
};
