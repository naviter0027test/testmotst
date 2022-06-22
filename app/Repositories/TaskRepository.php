<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Task;
use Exception;
use Config;

class TaskRepository
{
    public function lists($params) {
        $nowPage = isset($params['nowPage']) ? (int) $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? (int) $params['offset'] : 10;

        $taskQuery = Task::orderBy('created_at', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset);
        if(isset($params['projectId']) && $params['projectId'] > 0)
            $taskQuery->where('projectId', '=', $params['projectId']);
        $tasks = $taskQuery->get();
        return $tasks;
    }

    public function listsAmount($params) {
        $taskQuery = Task::orderBy('created_at', 'desc');
        if(isset($params['projectId']) && $params['projectId'] > 0)
            $taskQuery->where('projectId', '=', $params['projectId']);
        return $taskQuery->count();
    }

    public function create($params) {
        $nowDate = date('Y-m-d H:i:s');

        $task = new Task();
        $task->name = $params['name'];
        $task->projectId = $params['projectId'];
        $task->owner = $params['owner'];
        $task->start = $params['start'];
        $task->end = $params['end'];
        $task->hours = $params['hours'];
        $task->minutes = $params['minutes'];
        $task->desc = $params['desc'];
        $task->save();
    }

    public function remove($id) {
        Task::where('id', $id)->delete();
    }

    public function getById($id) {
        $task = Task::where('id', $id)->first();
        if(isset($task->id) == false)
            throw new Exception("任務:$id 不存在");
        return $task;
    }
}
