<?php

namespace Database\Seeders;
use App\Models\PersonalReport;
use App\Models\Role;
use App\Models\StandReports;
use App\Models\User;
use App\Models\Permission;
use App\Models\UsersRoles;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Console\Style\table;

class StandReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $StandReports = new StandReports();
        $StandReports->day = '1';
        $StandReports->time = '1';
        $StandReports->date = '2023-01-01';
        $StandReports->StandPublishers_id = '1';
        $StandReports->user_id = '1';
        $StandReports->publications = '0';
        $StandReports->videos = '0';
        $StandReports->return_visits = '0';
        $StandReports->bible_studies = '0';
        $StandReports->save();

        $PersonalReport = new PersonalReport();
        $PersonalReport->user_id = '1';
        $PersonalReport->year = '2020';
        $PersonalReport->month = '1';
        $PersonalReport->hours = '0';
        $PersonalReport->publications = '0';
        $PersonalReport->videos = '0';
        $PersonalReport->return_visits = '0';
        $PersonalReport->bible_studies = '0';
        $PersonalReport->save();
    }
}
