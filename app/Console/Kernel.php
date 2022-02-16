<?php

namespace App\Console;

use App\Tasks\ODPExtractor;
use App\Tasks\MachineLearningService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(new ODPExtractor)
            ->timezone('Europe/Paris')
            ->name('ODP Extract execution')
            ->everyMinute();

        $schedule->call(new MachineLearningService)
            ->timezone('Europe/Paris')
            ->name('ML Service execution')
            ->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
