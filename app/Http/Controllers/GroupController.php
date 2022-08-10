<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupStore;
use App\Models\Group;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;


class GroupController extends Controller
{

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

    public function startGroup(Request $request, Group $group)
    {
        $group->find($request->group_id)->update([
            'status' => 1,
            'start_time' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        return response()->json([
            'message' => "group was started"
        ], 200);
    }

    public function stopGroup(Request $request, Group $group)
    {
        $group->find($request->group_id)->update(['status' => 0, 'start_time' => 0]);

        return response()->json([
            'message' => "group was stopped"
        ], 200);
    }

    public function statusGroup(Group $group)
    {
        return response()->json([
            'status' => $group->status,
            'start_time' => $group->start_time,

        ], 200);
    }

}
