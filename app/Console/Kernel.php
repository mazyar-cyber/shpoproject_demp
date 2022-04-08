<?php

namespace App\Console;

use App\Models\Temp;
use Carbon\Carbon;
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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $tmps = Temp::all();
            foreach ($tmps as  $tmp) {
                if (Carbon::now()->diffInHours($tmp->created_at) > 2) {
                    @unlink(public_path('photos\products\tmp\\' . $tmp->filename));
                    $tmp->delete();
                }
            }
        });
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
