<?php

namespace App\Helpers;

use App\Jobs\StartTask;
use App\Models\Task;

class TaskDispatcher
{
    public static function dispatch(Task $task)
    {
        for ($i = $task->repetitions; $i > 0; --$i) {
            StartTask::dispatch($task, $i)->onQueue('task' . $task->id);
        }
       WorkerHelper::start($task->id, $task->frequency);
    }

}
