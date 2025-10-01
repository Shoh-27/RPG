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
        Schema::table('challenges', function (Blueprint $table) {
            $table->integer('duration_days')->default(7); // Admin nechi kun beradi
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable();
            $table->timestamp('deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('challenges', function (Blueprint $table) {
            //
        });
    }
};
