<?php

namespace App\Helpers;

use App\Models\Task;

class TaskHashHelper
{
    public static function makeHash(Task $task)
    {
        if (!$task->status) {
            $string = $task->string;
        }  else {
            $string = $task->hash;
        }
        $salt = str_pad((string)rand(1, 1000), 4, '0', STR_PAD_LEFT);
        return hash('sha256', $string) . "_" . $salt;
    }
}
