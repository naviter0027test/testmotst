<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Project;
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

    public function update($id, $params) {
        $task = Task::where('id', $id)->first();
        if(isset($task->id) == false)
            throw new Exception("任務:$id 不存在");

        $task->name = $params['name'];
        $task->start = $params['start'];
        $task->end = $params['end'];
        $task->hours = $params['hours'];
        $task->minutes = $params['minutes'];
        $task->desc = $params['desc'];
        $task->updated_at = date('Y-m-d H:i:s');
        $task->save();
    }

    public function getGanttByProjectId($projectId) {
        $project = Project::where('id', $projectId)->first();
        if(isset($project->id) == false)
            throw new Exception("專案:$id 不存在");
        $projectGantt = [];

        $tasks = Task::where('projectId', $projectId)
            ->orderBy('start', 'asc')->get();
        foreach($tasks as $task) {
            $t = [];
            $t['name'] = $project->title;
            $t['desc'] = $task->name;
            $t['id'] = $task->id;
            $t['values'] = [];

            $v = [];
            $v['from'] = $task->start;
            $v['to'] = $task->end;
            $v['label'] = $task->name;
            $v['desc'] = $task->start. " 到 ". $task->end. "<br />". nl2br($task->desc);

            $t['values'][] = $v;
            $projectGantt[] = $t;
        }
        return $projectGantt;
    }

    public function getGanttAll() {
        $tasks = Task::leftJoin('Project', 'Project.id', '=', 'Task.projectId')
            ->orderBy('start', 'asc')
            ->select(['Task.*', 'Project.title'])
            ->get();
        foreach($tasks as $task) {
            $t = [];
            $t['name'] = $task->title;
            $t['desc'] = $task->name;
            $t['id'] = $task->id;
            $t['values'] = [];

            $v = [];
            $v['from'] = $task->start;
            $v['to'] = $task->end;
            $v['label'] = $task->name;
            $v['desc'] = $task->start. " 到 ". $task->end. "<br />". nl2br($task->desc);

            $t['values'][] = $v;
            $projectGantt[] = $t;
        }
        return $projectGantt;
    }
}
