<?php

namespace App\Listeners;

use App\Console\Commands\IncreaseBalance;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class UserRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
//        DB::table('wallets')->insert([['wallet'=> $event->user->wallet]]);
        IncreaseBalance::increaseBalance($event->user, $event->user->daily_coef);
    }
}
