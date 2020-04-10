<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Help;
use App\Mail\WeeklyReport;
use Mail;
use App\Offer;
use App\Offeredhelp;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            $h = Help::where('active', true)
                ->where('closed', false)
                ->where('updated_at', '>=', date('Y-m-d', strtotime('-1 week')))
                ->get();

            $o = Offer::where('created_at', '>=', date('Y-m-d', strtotime('-1 week')))
                ->get();

            $m = Offeredhelp::where('created_at', '>=', date('Y-m-d', strtotime('-1 week')))
                ->get();
            
            Mail::to('rvrbk.dev@gmail.com')->send(new WeeklyReport($h, $o, $m));
        })->weekly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
