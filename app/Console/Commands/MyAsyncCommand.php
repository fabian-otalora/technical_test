<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SecurityPriceJob;

class MyAsyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:my-async-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process that syncs our security prices';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SecurityPriceJob::dispatch();
    }
}
