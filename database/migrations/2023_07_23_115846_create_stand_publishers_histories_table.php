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
        Schema::create('stand_publishers_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('day');
            $table->integer('time');
            $table->date('date');
            $table->unsignedBigInteger('stand_publishers_id');
            $table->unsignedBigInteger('stand_id')->nullable();
            $table->json('publishers')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stand_publishers_histories');
    }
};
