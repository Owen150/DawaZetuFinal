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
        Schema::create('facility_external_requests_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('strength');
            $table->string('unit_of_issue');
            $table->string('unit_size');
            $table->string('available_units');
            $table->string('requested_units');
            $table->string('requested_by');
            $table->string('request_date');
            $table->string('request_id');
            $table->string('facility_id');

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
        Schema::dropIfExists('facility_external_requests_details');
    }
};
