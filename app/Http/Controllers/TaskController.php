<?php

namespace App\Http\Controllers;

use App\Helpers\TaskHashHelper;
use App\Helpers\TaskHelper;
use App\Jobs\StartTask;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @OA\Get(
     *      path="/task/{task}",
     *      operationId="getListAvailableChannel",
     *      tags={"task"},
     *      summary="получение статуса задания",
     *      description="Метод возвращает данные ...",
     *     @OA\Parameter(
     *          name="task",
     *          description="id задания",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *     )
     */

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
    /**
     * @OA\Get(
     *      path="/taskAll",
     *      operationId="liastAllTask",
     *      tags={"task"},
     *      summary="Возвращает список всех заданий",
     *      description="Метод возвращает данные ...",

     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *     )
     */
    public function statusAll(Request $request, Task $task)
    {
        return response()->json([
            $task->statusAll()
        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/task",
     *      operationId="storeTask",
     *      tags={"task"},
     *      summary="создать задание",
     *      description="Метод возвращает данные ...",

     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *     )
     */
    public function store(Task $task, Request $request)
    {
        $task->fill($request->all());
        $task->save();
        return response()->json([
            'message' => 'task was created'
        ], 200);
    }

    public function stopTask(Task $task, Request $request)
    {
        $task->find($request->task)->update(['status' => 0]);
        return response()->json([
            'message' => 'task was stopped'
        ], 200);
    }

    public function startTask(Task $task, Request $request)
    {
        $hash = TaskHashHelper::makeHash($task->find($request->task));
        $task->find($request->task)->update(['status' => 1, 'hash' => $hash]);
        StartTask::dispatch($task->find($request->task));
        return response()->json([
            'message' => 'task was started'
        ], 200);
    }

}
