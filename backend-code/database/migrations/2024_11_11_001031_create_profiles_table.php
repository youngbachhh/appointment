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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('national_id')->unique();
            $table->date('birthdate');
            $table->unsignedSmallInteger('gender');
            $table->unsignedBigInteger('province_id');
            $table->string('ethnicity');
            $table->string('phone');
            $table->string('address');
            $table->unsignedSmallInteger('insurance_type')->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('insurance_expiration')->nullable();
            $table->boolean('priority')->default(false);
            $table->unsignedSmallInteger('status')->default(1);
            $table->unsignedBigInteger('job');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
