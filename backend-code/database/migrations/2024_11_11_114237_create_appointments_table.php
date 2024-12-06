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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->unsignedBigInteger('time_slot_id');
            $table->foreign('time_slot_id')->references('id')->on('time_slots');

            $table->boolean('reminder_sent')->default(false);
            $table->unsignedSmallInteger('status')->default(0);
            $table->text('notes')->nullable();
    
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
