<?php

namespace App\Console;

use App\Models\StandTemplate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void {

        $schedule->command('create:insertPublishersNextWeekDate')->weeklyOn(4, '08:00');
        $schedule->command('app:update-templates')->weeklyOn(7, '23:59');
        $schedule->command('app:update-publishers')->weeklyOn(7, '23:59');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
