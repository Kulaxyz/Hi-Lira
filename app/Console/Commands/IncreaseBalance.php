<?php

namespace App\Console\Commands;

use App\Setting;
use App\User;
use Illuminate\Console\Command;

class IncreaseBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'increase:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command increases users balance daily on 1.2%';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('balance', '>', 0)->get();
        $min = Setting::where('key', 'min_coef')->first()->value;
        $max = Setting::where('key', 'max_coef')->first()->value;

        foreach ($users as $user) {
            $coef = ($min + mt_rand() / mt_getrandmax() * ($max - $min));
            self::increaseBalance($user, $coef);
        }
    }

    public static function increaseBalance($user, $coef)
    {
        $user->balance += round($user->balance * ($coef/100), 2);
        $user->daily_coef = $coef;
        $user->save();
    }
}
