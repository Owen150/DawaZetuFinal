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
        Schema::create('drawing_rights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id');
            $table->unsignedBigInteger('finacial_year_id');
            $table->unsignedBigInteger('allocated_budget_id');
            $table->string('workload');
            $table->string('period');
            $table->string('amount');
            $table->string('used_amount');
            $table->string('original_amount');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('allocated_budget_id')->references('id')->on('allocated_budgets');
            $table->foreign('facility_id')->references('id')->on('facilities');
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
        Schema::dropIfExists('drawing_rights');
    }
};
