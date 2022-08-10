<?php

namespace App\Http\Controllers;

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
                $startTime = $task->start_time;
                break;
            case 2:
                $status = 'finish';
                break;
        }

        return response()->json([
            'status' => $status,
            'start_time' => $startTime ?? NULL
        ], 200);
    }

    public function statusAll(Request $request, Task $task)
    {
        return response()->json([
            $task->statusAll()
        ], 200);
    }

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

    /* public function status(Task $task, Group $group)
     {
         $group = $group->find(1);
         foreach ($group->tasks as $task) {
             echo $task;
         }
         return response()->json([
             'message' => $task->all()
         ], 200);
     }*/
}
