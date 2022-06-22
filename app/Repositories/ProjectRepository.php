<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Project;
use Exception;
use Config;

class ProjectRepository
{
    public function create($params) {
        $nowDate = date('Y-m-d H:i:s');

        $project = new Project();
        $project->title = $params['title'];
        $project->requirement = $params['requirement'];
        $project->isPublic = $params['isPublic'];
        $project->created_at = $nowDate;
        $project->updated_at = $nowDate;
        $project->save();
    }

    public function lists($params) {
        $nowPage = isset($params['nowPage']) ? (int) $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? (int) $params['offset'] : 10;

        $projectQuery = Project::orderBy('created_at', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset);
        $projects = $projectQuery->get();
        foreach($projects as $i => $project) {
            if($project->isPublic == 1)
                $projects[$i]->isPublicShow = '是';
            else
                $projects[$i]->isPublicShow = '否';
        }
        return $projects;
    }

    public function listsAmount($params) {
        $projectQuery = Project::orderBy('created_at', 'desc');
        return $projectQuery->count();
    }

    public function remove($id) {
        Project::where('id', $id)->delete();
    }

    public function getById($id) {
        $project = Project::where('id', $id)->first();
        if(isset($project->id) == false)
            throw new Exception("專案:$id 不存在");
        return $project;
    }

    public function update($id, $params) {
        $project = Project::where('id', $id)->first();
        if(isset($project->id) == false)
            throw new Exception("專案:$id 不存在");

        $project->title = $params['title'];
        $project->isPublic = $params['isPublic'];
        $project->requirement = $params['requirement'];
        $project->updated_at = date('Y-m-d H:i:s');
        $project->save();
    }
}
