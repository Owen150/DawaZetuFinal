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
        Schema::create('store_top_ups', function (Blueprint $table) {
            $table->id();
            $table->string('requested_by');
            $table->string('request_date');
            $table->string('status');
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
        Schema::dropIfExists('store_top_ups');
    }
};
