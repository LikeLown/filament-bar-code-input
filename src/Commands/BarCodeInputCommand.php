<?php

namespace LikeLown\BarCodeInput\Commands;

use Illuminate\Console\Command;

class BarCodeInputCommand extends Command
{
    public $signature = 'filament-bar-code-input';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
