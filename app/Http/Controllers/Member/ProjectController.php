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
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.project.index', ['member' => $member, 'result' => $result]);
    }

    public function createPage(Request $request) {
    }

    public function create(Request $request) {
    }
}
