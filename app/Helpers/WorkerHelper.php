<?php

namespace App\Helpers;

use App\Jobs\StartTask;
use App\Models\Task;

class WorkerHelper
{
    public static function start(int $id, int $frequency = 1000)
    {
        exec('php /var/www/html/artisan queue:work --queue=task' . $id . ' --stop-when-empty --max-time=300 --sleep=' . $frequency / 1000 . ' &');
    }
}
