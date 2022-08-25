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

    public function lists($params) {
        $nowPage = isset($params['nowPage']) ? (int) $params['nowPage'] : 1;
        $offset = isset($params['offset']) ? (int) $params['offset'] : 10;

        $contentQuery = Content::orderBy('updated_at', 'desc')
            ->skip(($nowPage-1) * $offset)
            ->take($offset);
        $contents = $contentQuery->get();
        return $contents;
    }

    public function listsAmount($params) {
        $contentQuery = Content::orderBy('created_at', 'desc');
        return $contentQuery->count();
    }

    public function remove($id) {
        Content::where('id', $id)->delete();
    }

    public function getById($id) {
        $content = Content::where('id', $id)->first();
        if(isset($content->id) == false)
            throw new Exception("專案:$id 不存在");
        return $content;
    }

    public function update($id, $params) {
        $content = Content::where('id', $id)->first();
        if(isset($content->id) == false)
            throw new Exception("專案:$id 不存在");

        $content->title = $params['title'];
        $content->content = $params['content'];
        $content->updated_at = date('Y-m-d H:i:s');
        $content->save();
    }
}
