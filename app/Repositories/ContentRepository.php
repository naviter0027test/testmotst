<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Content;
use Exception;
use Config;

class ContentRepository
{
    public function create($params) {
        $nowDate = date('Y-m-d H:i:s');

        $content = new Content();
        $content->title = $params['title'];
        $content->content = $params['content'];
        $content->created_at = $nowDate;
        $content->updated_at = $nowDate;
        $content->save();
    }
}
