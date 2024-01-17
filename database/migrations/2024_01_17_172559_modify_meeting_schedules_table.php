<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMeetingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_schedules', function (Blueprint $table) {
            $table->dropColumn(['type_day', 'start_of_week', 'end_of_week']);
            $table->unsignedBigInteger('ms_template_id');
            $table->foreign('ms_template_id')->references('id')->on('meeting_schedule_templates');
            $table->date('date')->after('congregation_id')->format('Y-m-d');
            $table->json('schedule')->after('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting_schedules', function (Blueprint $table) {
            $table->string('type_day');
            $table->date('start_of_week')->format('Y-m-d');
            $table->date('end_of_week')->format('Y-m-d');
            $table->dropColumn(['ms_template_id', 'date', 'schedule']);
            $table->foreign('congregation_id')->references('id')->on('congregations');
        });
    }
};
