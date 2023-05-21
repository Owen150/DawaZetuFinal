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
        Schema::create('filled_store_requests', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('strength');
            $table->string('unit_of_issue');
            $table->string('unit_size');
            $table->string('available_units');
            $table->string('requested_units');
            $table->string('allocated_units');
            $table->string('processed_by');
            $table->string('requested_facility');

            $table->string('request_id');
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
        Schema::dropIfExists('filled_store_requests');
    }
};
