<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('nextgentrip:health', function (): int {
    $this->info('NextGenTrip foundation is ready.');

    return self::SUCCESS;
});
