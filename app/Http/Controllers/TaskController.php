<?php

namespace App\Http\Controllers;

use App\Helpers\TaskDispatcher;
use App\Helpers\TaskHashHelper;
use App\Helpers\TaskHelper;
use App\Jobs\StartTask;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function status(Task $task)
    {
        switch ($task->status) {
            case 0:
                $status = 'disable';
                break;
            case 1:
                $status = 'active';
                break;
            case 2:
                $status = 'finish';
                break;
        }

        return response()->json([
            'status' => $status
        ], 200);
    }

    public function statusAll(Request $request, Task $task)
    {
        return response()->json([
            $task->statusAll()
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        $task->find($request->task)->update(['group_id' => $request->group_id]);
        return response()->json([
            'message' => 'task was updated'
        ], 200);
    }


    public function store(Task $task, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'string' => 'required|min:10',
            'frequency' => 'required|integer|between:1000,4000',
            'repetitions' => 'required|integer|between:1,20',
            'group_id' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 400);
        }
        $task->fill($request->all());
        if ($task->save()) {
            return response()->json([
                'message' => 'task was created'
            ], 200);
        } else {
            return response()->json([
                'message' => 'task was NOT created'
            ], 400);
        }

    }

    public function stop(Task $task, Request $request)
    {
        $task->find($request->task)->update(['status' => 0]);
        return response()->json([
            'message' => 'task was stopped'
        ], 200);
    }

    public function start(Task $task, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 400);
        }
        TaskDispatcher::dispatch($task->find($request->task));
        //$task->find($request->task)->update(['status' => 0]);

        return response()->json([
            'message' => 'task was started'
        ], 200);
    }

}
