<?php

namespace App\Console;

use App\Jobs\SendEmailJob;
use App\Models\User;
use App\Service\Currency\ICurrency;
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
        // It'll resize images in storage/app/public/images folder every a hour
        $schedule->command('image:resize')->hourly();

        // It'll check currency prices every 2 hour 
        $schedule->call(function () {
            $currency = app(ICurrency::class);
            $prices = $currency->getCurrencyPrice();
            if (!is_null($prices)) {
                $users = User::all();
                foreach ($users as $user) {
                    $data = [
                        "name" => $user->name,
                        "email" => $user->email,
                        "subject" => "Currency price",
                        "prices" => $prices
                    ];
                    SendEmailJob::dispatch($data)->onConnection('redis');
                }
            }
        })->everyTwoHours();
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
