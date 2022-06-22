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
            $taskRepository = new TaskRepository();
            $result['project'] = $projectRepository->getById($projectId);
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
}
