<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandsPublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stands_publishers', function (Blueprint $table) {
            $table->id();
            $table->integer('day');
            $table->integer('time');
            $table->date('date');
            $table->unsignedBigInteger('stand_template_id');
            $table->json('publishers')->nullable();
            $table->timestamps();


            $table->foreign('stand_template_id')->references('id')->on('stand_templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stands_publishers');
    }
}
