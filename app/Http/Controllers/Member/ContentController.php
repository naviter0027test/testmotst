<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Http\Controllers\Controller;
use App\Repositories\ContentRepository;
use Session;
use Exception;

class ContentController extends Controller
{
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
            $contentRepository = new ContentRepository();
            $result['contents'] = $contentRepository->lists($params);
            $result['amount'] = $contentRepository->listsAmount($params);
            $result['nowPage'] = $params['nowPage'];
            $result['offset'] = $params['offset'];
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.content.index', ['member' => $member, 'result' => $result]);
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
        return view('member.content.create', ['member' => $member, 'result' => $result]);
    }

    public function create(Request $request) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $params = $request->all();
            $contentRepository = new ContentRepository();
            $contentRepository->create($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.proccess', ['member' => $member, 'result' => $result]);
    }
}
