<?php

namespace App\Console;

use App\Console\Commands\AcceptPost;
use App\Console\Commands\DeleteUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    $schedule->command('post:accept-post')->everyTwoHours();
    $schedule->command('user:delete-user')->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
        AcceptPost::class;
        DeleteUser::class;
    }
}
