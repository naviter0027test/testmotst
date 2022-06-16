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
    public function example() {
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
}
