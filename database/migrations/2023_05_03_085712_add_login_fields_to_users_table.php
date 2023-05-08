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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('clock_number')->nullable();
            $table->string('img')->nullable();
            $table->string('company')->nullable();
            $table->string('job')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->string('deputy_email')->nullable();
            $table->integer('vice_clock_number')->nullable();
            $table->boolean('flag')->default(false);


            $table->datetime('last_login_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('last_login_ip')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
