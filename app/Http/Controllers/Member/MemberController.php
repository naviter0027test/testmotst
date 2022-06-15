<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Http\Controllers\Controller;
use App\Repositories\MemberRepository;
use Session;
use Exception;

class MemberController extends Controller
{
    public function index(Request $request) {
        return redirect('/member/home');
    }

    public function home(Request $request) {
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
            return view('member.proccessResult', ['adm' => $member, 'result' => $result]);
        }
        return view('member.home', ['adm' => $member, 'result' => $result]);
    }

    public function loginPage(Request $request) {
        return view('member.login');
    }

    public function login(Request $request) {
        $params = $request->all();
        $params['account'] = isset($params['account']) ? $params['account'] : '';
        $params['password'] = isset($params['password']) ? $params['password'] : '';
        $memberRepository = new MemberRepository();
        $member = $memberRepository->checkPassword($params);
        $result = [
        ];
        if(isset($member->id) == true) {
            Session::put('member', $member);
            return redirect('/member/home');
        } else if(isset($member->id) == true && $member->active == 0) {
            $result['errMsg'] = '帳號未啟用';
        } else
            $result['errMsg'] = '帳密有誤';
        return view('member.login', ['result' => $result]);
    }

    public function logout(Request $request) {
        Session::flush();
        return redirect('/member/login');
    }

    public function passwordPage(Request $request) {
        $member = Session::get('member');
        return view('member.password', ['member' => $member]);
    }

    public function passwordUpdate(Request $request) {
        $member = Session::get('member');
        $params = $request->all();
        $params['account'] = $member->account;
        $result = [
            'result' => true,
            'msg' => 'success',
        ];

        try {
            $memberRepository = new MemberRepository();
            $memberRepository->updatePassword($params);
        }
        catch(Exception $e) {
            $result['result'] = false;
            $result['msg'] = $e->getMessage();
        }
        return view('member.proccess', ['member' => $member, 'result' => $result]);
    }
}
