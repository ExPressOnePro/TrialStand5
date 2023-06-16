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
        Schema::create('stand_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publications');
            $table->unsignedBigInteger('videos');
            $table->unsignedBigInteger('return_visits');
            $table->unsignedBigInteger('bible_studies');
            $table->unsignedBigInteger('StandPublishers_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stand_reports');
    }
};
