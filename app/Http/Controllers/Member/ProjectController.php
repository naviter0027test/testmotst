<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use Session;
use Exception;

class ProjectController extends Controller
{
    public function example(Request $request) {
        $result = [
            [
                'name' => "AAA",
                'desc' => "AAA desc",
                'values' => [
                    [
                        'from' => '2022-01-01',
                        'to' => '2022-01-20',
                        'label' => 'AAA task 1',
                        'desc' => 'AAA task 1 desc',
                    ],
                ],
                'id' => 1,
                'cssClass' => 'redLabel',
            ],
        ];
        return json_encode($result);
    }

    public function index(Request $request) {
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
        ];
        try {
            $projectRepository = new ProjectRepository();
            $result['projects'] = $projectRepository->lists($params);
            $result['amount'] = $projectRepository->listsAmount($params);
            $result['nowPage'] = $params['nowPage'];
            $result['offset'] = $params['offset'];
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.project.index', ['member' => $member, 'result' => $result, 'params' => $params]);
    }

    public function createPage(Request $request) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.project.create', ['member' => $member, 'result' => $result]);
    }

    public function create(Request $request) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $params = $request->all();
            $projectRepository = new ProjectRepository();
            $projectRepository->create($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.proccess', ['member' => $member, 'result' => $result]);
    }
}
