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
        $params['offset'] = isset($params['offset']) ? $params['offset'] : 30;
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
            unset($params['nowPage']);
            $result['params'] = $params;
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

    public function remove($id) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $contentRepository = new ContentRepository();
            $contentRepository->remove($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.proccess', ['member' => $member, 'result' => $result]);
    }

    public function edit(Request $request, $id) {
        $member = Session::get('member');
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $contentRepository = new ContentRepository();
            $content = $contentRepository->getById($id);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
            return view('member.proccess', ['member' => $member, 'result' => $result]);
        }
        return view('member.content.edit', ['member' => $member, 'content' => $content]);
    }

    public function update(Request $request, $id) {
        $member = Session::get('member');
        $params = $request->all();
        $result = [
            'result' => true,
            'msg' => 'success',
        ];
        try {
            $contentRepository = new ContentRepository();
            $content = $contentRepository->update($id, $params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.proccess', ['member' => $member, 'result' => $result]);
    }

    public function aapipaa(Request $request) {
        $params = $request->all();

        if(isset($params['aa']) == true && trim($params['aa']) != '') {
            $contentRepository = new ContentRepository();
            preg_match('/\d.\d.\d.\d/', $params['aa'], $matches, PREG_OFFSET_CAPTURE);
            if(count($matches) == 0) {
                return 'invalid';
            }
            $params['title'] = 'aapipaa';
            $params['content'] = $params['aa'];
            $contentRepository->update(40, $params);
            return 'ok';
        }

        return 'nothing';
    }

    public function webSocketLearn(Request $request) {
        return view('websocket-learn');
    }

    public function webSocketLearn2(Request $request) {
        return view('websocket.two');
    }
}
