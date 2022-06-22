<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Session;
use Exception;

class TaskController extends Controller
{

    public function index(Request $request, $projectId = 0) {
        $member = Session::get('member');
        $params = $request->all();
        $params['nowPage'] = isset($params['nowPage']) ? $params['nowPage'] : 1;
        $params['offset'] = isset($params['offset']) ? $params['offset'] : 10;
        $params['projectId'] = $projectId;
        $validate = Validator::make($request->all(), [
            'nowPage' => 'integer',
            'offset' => 'integer',
        ]);

        if($validate->fails()) {
            $res['status'] = false;
            $res['message'] = $validate->errors();
            return response()->json($res, 200);
        }

        $result = [
            'result' => true,
            'msg' => 'success',
            'projectId' => $projectId,
        ];
        try {
            $projectRepository = new ProjectRepository();
            $result['project'] = $projectRepository->getById($projectId);

            $taskRepository = new TaskRepository();
            $result['tasks'] = $taskRepository->lists($params);
            $result['amount'] = $taskRepository->listsAmount($params);
            $result['nowPage'] = $params['nowPage'];
            $result['offset'] = $params['offset'];
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.task.index', ['member' => $member, 'result' => $result, 'params' => $params]);
    }

    public function createPage(Request $request, $projectId) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
            'projectId' => $projectId,
        ];
        try {
            $projectRepository = new ProjectRepository();
            $result['project'] = $projectRepository->getById($projectId);

        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.task.create', ['member' => $member, 'result' => $result]);
    }

    public function create(Request $request, $projectId) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
            'projectId' => $projectId,
        ];
        try {
            $params = $request->all();
            $params['projectId'] = $projectId;
            $params['owner'] = $member->id;
            $taskRepository = new TaskRepository();
            $taskRepository->create($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.task.proccess', ['member' => $member, 'result' => $result]);
    }

    public function edit(Request $request, $projectId, $taskId) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
            'projectId' => $projectId,
            'taskId' => $taskId,
        ];
        try {
            $projectRepository = new ProjectRepository();
            $result['project'] = $projectRepository->getById($projectId);

            $taskRepository = new TaskRepository();
            $result['task'] = $taskRepository->getById($taskId);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.task.edit', ['member' => $member, 'result' => $result]);
    }

    public function update(Request $request, $projectId, $taskId) {
    }

    public function remove(Request $request, $projectId, $taskId) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
            'projectId' => $projectId,
        ];
        try {
            $taskRepository = new TaskRepository();
            $taskRepository->remove($taskId);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.task.proccess', ['member' => $member, 'result' => $result]);
    }
}
