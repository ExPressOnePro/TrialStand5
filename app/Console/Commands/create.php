<?php

namespace App\Console\Commands;

use App\Models\Congregation;
use App\Models\Stand;
use App\Models\StandPublishers;
use App\Models\StandTemplate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:insertPublishersNextWeekDate';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {

    }
}
