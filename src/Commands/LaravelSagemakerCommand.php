<?php

namespace ThePLAN\LaravelSagemaker\Commands;

use Illuminate\Console\Command;

class LaravelSagemakerCommand extends Command
{
    public $signature = 'laravel-sagemaker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
