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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employee_number');
            $table->string('designation');

            /**
             * admin
             * county pharmacist - cp
             * COUNTY MEDICAL DEPARTMENT DIRECTOR - cd
             * COUNTY MEDICAL DEPARTMENT CHIEF OFFICER - co
             * EXECUTIVE DASHBOARD - ee
             * SUB-COUNTY PHARMACIST -scp
             * HEALTH FACILITIES PHARMACIST - hfp
             * patient - pt
             * 
             */
            $table->string('two_factor_code')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->string('role');
            $table->string('phone_number');
          
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('facility_id')->nullable()->constrained();
            $table->rememberToken();
            $table->boolean('changed_password')->default(0);

            $table->string('sub_county')->nullable();
            $table->string('ward')->nullable();
            $table->timestamps();


            $table->foreign('facility_id')->references('id')->on('facilities')->nullOnDelete()->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
