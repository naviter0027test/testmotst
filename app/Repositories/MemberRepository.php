<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Member;
use Exception;
use Config;

class MemberRepository
{
    public function checkPassword($params) {
        $member = Member::where('account', '=', $params['account'])
            ->where('pass', '=', md5($params['password']))
            ->first();
        if(isset($member->id)) {
            return $member;
        }
        return false;
    }
}
