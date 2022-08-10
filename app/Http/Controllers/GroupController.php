<?php

namespace App\Http\Controllers;

use App\Helpers\TaskHelper;
use App\Http\Requests\GroupStore;
use App\Jobs\StartTask;
use App\Models\Group;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;


class GroupController extends Controller
{

    /**
     * @OA\Post(
     *      path="/group",
     *      operationId="makeGroup",
     *      tags={"group"},
     *      summary="созадать группу",
     *      description="Метод возвращает данные ...",
     *     @OA\Parameter(
     *          name="group",
     *          description="id группы",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Group")
     *       ),
     *     )
     */
    public function makeGroup(GroupStore $request, Group $group, Task $task)
    {
        $group->fill($request->validated());
        $group->save();
        $groupId = $group->id;
        $tasks = $request->task;
        foreach ($tasks as $id) {
            $task = $task->find($id);
            $task->group_id = $groupId;
            $task->save();
        }

        return response()->json([
            'message' => 'group was created'
        ], 200);
    }


    /**
     * @OA\Post(
     *      path="/groupstart",
     *      operationId="startGroup",
     *      tags={"group"},
     *      summary="запустить задачи в группе",
     *      description="Метод возвращает данные ...",
     *     @OA\Parameter(
     *          name="group",
     *          description="id группы",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Group")
     *       ),
     *     )
     */
    public function startGroup(Request $request, Group $group)
    {
        $group = $group->find($request->group_id);
        $group->update(['status' => 1]);
        foreach ($group->tasks as $task) {
            TaskHelper::start($task);
            StartTask::dispatch($task);
        }

        return response()->json([
            'message' => "group was started"
        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/groupstop",
     *      operationId="stopGroup",
     *      tags={"group"},
     *      summary="остановить задачи в группе",
     *      description="Метод возвращает данные ...",
     *     @OA\Parameter(
     *          name="group",
     *          description="id группы",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Group")
     *       ),
     *     )
     */
    public function stopGroup(Request $request, Group $group)
    {
        $group = $group->find($request->group_id);
        $group->update(['status' => 0]);
        foreach ($group->tasks as $task) {
            TaskHelper::stop($task);
        }

        return response()->json([
            'message' => "group was stopped"
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/group/{group}",
     *      operationId="getGroupStatus",
     *      tags={"group"},
     *      summary="получение статуса группы",
     *      description="Метод возвращает данные ...",
     *     @OA\Parameter(
     *          name="group",
     *          description="id группы",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/Group")
     *       ),
     *     )
     */
    public function statusGroup(Group $group)
    {
        return response()->json([
            'status' => $group->status
        ], 200);
    }

}
