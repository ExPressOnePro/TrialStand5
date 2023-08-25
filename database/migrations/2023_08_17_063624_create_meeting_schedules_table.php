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
        Schema::create('meeting_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('congregation_id');
            $table->date('start_of_week')->format('Y-m-d');
            $table->date('end_of_week')->format('Y-m-d');
            $table->string('type_day');
            $table->json('schedule');
            $table->timestamps();

            $table->foreign('congregation_id')->references('id')->on('congregations');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_schedules');
    }
};
