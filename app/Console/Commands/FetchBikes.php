<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\NextBikeController;

class FetchBikes extends Command {

    protected $signature = 'nextbike:fetch';

    public function handle(): int {
        NextBikeController::fetchBikes();
        return 0;
    }
}
