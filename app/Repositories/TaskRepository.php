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
        $tasks = $taskQuery->get();
        return $tasks;
    }

    public function listsAmount($params) {
        $taskQuery = Task::orderBy('created_at', 'desc');
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
}
