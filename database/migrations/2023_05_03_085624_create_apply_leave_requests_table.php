<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apply_leave_requests', function (Blueprint $table) {
            $table->id();
            $table->string('LM');
            $table->string('Subject');
            $table->string('personal_email');
            $table->string('emergency_tel');
            $table->string('country_of_domicile');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('ASR');
            $table->date('FROM');
            $table->date('TO');
            $table->string('leave_type');
            $table->string('LM_type')->nullable();
            $table->string('HR_type')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_leave_requests');
    }
};
