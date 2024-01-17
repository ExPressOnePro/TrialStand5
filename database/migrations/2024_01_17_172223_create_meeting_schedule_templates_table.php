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
        Schema::create('meeting_schedule_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_name');
            $table->unsignedBigInteger('congregation_id');
            $table->json('template');
            $table->timestamps();

            $table->foreign('congregation_id')->references('id')->on('congregations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_schedule_templates');
    }
};
