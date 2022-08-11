<?php

namespace App\Helpers;

use App\Jobs\StartTask;
use App\Models\Task;

class TaskHelper
{
    public static function start(Task $task)
    {
        $hash = TaskHashHelper::makeHash($task);
        $task->update(['status' => 1, 'hash' => $hash, 'done_repetitions' => 1]);
    }

    public static function stop(Task $task)
    {
        $task->update(['status' => 0, 'done_repetitions' => 0]);
    }


}
