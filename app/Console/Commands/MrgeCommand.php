<?php

namespace App\Console\Commands;

use App\Http\Controllers\MrgeJobController;
use Illuminate\Console\Command;

class MrgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mrgejob:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will pull jobs from the external api and insert/update it to our local Database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new MrgeJobController())->updateMrgeJobsFromExternalApi();
    }
}
