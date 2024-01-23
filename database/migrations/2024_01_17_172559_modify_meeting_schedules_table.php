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
            $table->dropForeign(['congregation_id']);
            $table->dropColumn(['start_of_week', 'end_of_week', 'congregation_id', 'type_day']);


            $table->date('week_from')->after('id');
            $table->dateTime('weekday_time')->after('week_from');
            $table->dateTime('weekend_time')->after('weekday_time');
            $table->unsignedBigInteger('ms_template_id')->after('weekend_time');
            $table->boolean('published')->default(false)->after('ms_template_id'); // опубликованно ли расписание?
            $table->json('viewed_by_users')->default(json_encode([]))->after('published'); // пользователи просмотревшие

            $table->foreign('ms_template_id')->references('id')->on('meeting_schedule_templates');
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
            // Откатываем изменения
            $table->dropForeign(['ms_template_id']);
            $table->dropColumn(['date', 'ms_template_id']);
            $table->unsignedBigInteger('congregation_id')->after('id');
            $table->date('start_of_week')->format('Y-m-d')->after('congregation_id');
            $table->date('end_of_week')->format('Y-m-d')->after('start_of_week');
            $table->string('type_day')->after('end_of_week');

            // Восстанавливаем внешний ключ
            $table->foreign('congregation_id')->references('id')->on('congregations');
        });
    }
};
