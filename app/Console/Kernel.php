<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MakeOldProduct;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DeleteUnapprovedSeller::class,
        Commands\ExpireHotDeal::class,
        Commands\AddProductToHotDeal::class,
        Commands\SendHotDealExpireEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:deleteunapprovedseller')
            ->everyMinute();
        $schedule->command('command:expirehotdeal')
            ->everyMinute();
        $schedule->command('command:addproducttohotdeal')
            ->everyMinute();
        $schedule->command('command:sendhotdealexpireemail')
            ->daily();
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
