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
        Schema::table('stands_publishers', function (Blueprint $table) {
            $table->time('time')->change();
        });
        Schema::table('stand_publishers_histories', function (Blueprint $table) {
            $table->time('time')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stands_publishers_and_stand_publishers_history', function (Blueprint $table) {
            //
        });
    }
};
