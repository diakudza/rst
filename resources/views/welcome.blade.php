<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="width: 80%; margin: 0 auto ">
    <div style="display: flex; flex-direction: row; justify-content: space-between">
        <div>
            <p>Задачи</p>
            <table>
                <tr>
                    <td>id</td>
                    <td>group</td>
                    <td>string</td>
                    <td>status</td>
                    <td>hash</td>
                </tr>
                @foreach( $allTask as $task )
                    <tr style="background-color: @if($task->status == 1) #1fe04b @else #ee5353 @endif ">
                        <td>{{ $task->id }}</td>
                        <td>
                            <form action="/api/task-update" method="post">
                                <input type="hidden" name="task" value="{{ $task->id }}">
                            <select name="group_id">
                                <option @if($task->group_id == 0) selected @endif>Х</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}"
                                            @if($task->group_id == $group->id) selected @endif
                                    >{{$group->id}}</option>
                                @endforeach
                            </select>
                                <button>+</button>
                            </form>
                        </td>
                        <td>{{ $task->string }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->hash }}</td>
                        <td>
                            @if($task->status == 0)
                                <form action="/api/task-start" method="post">
                                    <input type="hidden" name="task" value="{{$task->id}}">
                                    <button>start</button>
                                </form>
                            @else
                                <form action="/api/task-stop" method="post">
                                    <input type="hidden" name="task" value="{{$task->id}}">
                                    <button>stop</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <form action="/api/task-store" method="post">
                <input type="text" name="string" placeholder="строка">
                <input type="text" name="frequency" placeholder="Интервал мс">
                <input type="text" name="repetitions" placeholder="колличество повторений ">
                <button>Добавить задачу</button>
            </form>
        </div>
        <div>
            <p>Группы</p>
            <table>
                @foreach( $groups as $group )
                    <tr style="background-color: @if($group->status == 1) #1fe04b @else #ee5353 @endif ">
                        <td>{{ $group->id }}</td>

                        <td>
                            <div>{{ $group->title }}</div>
                            <div>
                                @foreach($group->tasks as $task)
                                    {{ $task->id  }}
                                @endforeach
                            </div>
                        </td>
                        <td>{{ $group->status }}</td>
                        <td>
                            @if($group->status == 0)
                                <form action="/api/group-start" method="post">
                                    <input type="hidden" name="group_id" value="{{$group->id}}">
                                    <button>start</button>
                                </form>
                            @else
                                <form action="/api/group-stop" method="post">
                                    <input type="hidden" name="group_id" value="{{$group->id}}">
                                    <button>stop</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <form action="/api/group-store" method="post">
                <div style="display: flex">
                    @foreach($allTask as $task)

                        <div style="display: flex ">
                            <p>{{ $task->id}}</p>
                            <input type="checkbox" name="tasks[]" value="{{$task->id}}">
                        </div>

                    @endforeach
                </div>
                <input type="text" name="title" placeholder="название">
                <button>Добавить группу</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>
