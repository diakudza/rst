<?php

namespace App\Http\Controllers;

use App\Helpers\TaskDispatcher;
use App\Helpers\TaskHelper;
use App\Http\Requests\GroupStore;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GroupController extends Controller
{

    public function store(Request $request, Group $group, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5|max:100',
            'tasks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 400);
        }
        $group->fill($validator->validated());
        $group->save();
        $groupId = $group->id;
        $tasks = $validator->validated()['tasks'];
        foreach ($tasks as $id) {
            $task = $task->find($id);
            $task->group_id = $groupId;
            $task->save();
        }

        return response()->json([
            'message' => 'group was created'
        ], 200);
    }

    public function start(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 400);
        }

        $group = $group->find($request->group_id);

        $group->update(['status' => 1]);

        foreach ($group->tasks as $task) {
            TaskDispatcher::dispatch($task);
        }

        return response()->json([
            'message' => "group was started"
        ], 200);
    }

    public function stop(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 400);
        }

        $group = $group->find($request->group_id);
        $group->update(['status' => 0]);
        foreach ($group->tasks as $task) {
            TaskHelper::stop($task);
        }

        return response()->json([
            'message' => "group was stopped"
        ], 200);
    }

    public function status(Group $group)
    {
        return response()->json([
            'status' => $group->status
        ], 200);
    }

}
