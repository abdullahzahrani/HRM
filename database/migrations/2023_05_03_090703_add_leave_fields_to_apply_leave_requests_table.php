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
        Schema::table('apply_leave_requests', function (Blueprint $table) {
            $table->string('ASR2')->nullable();
            $table->date('FROM2')->nullable();
            $table->string('TO2')->nullable();
            $table->string('leave_type2')->nullable();

            $table->string('ASR3')->nullable();
            $table->date('FROM3')->nullable();
            $table->string('TO3')->nullable();
            $table->string('leave_type3')->nullable();

            $table->string('ASR4')->nullable();
            $table->date('FROM4')->nullable();
            $table->string('TO4')->nullable();
            $table->string('leave_type4')->nullable();

            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_leave_requests', function (Blueprint $table) {
            //
        });
    }
};
