<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-sigapn', function () {
    $this->info('SIGAPN siap digunakan.');
});
