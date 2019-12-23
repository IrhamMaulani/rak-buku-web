<?php

namespace App\Services;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagService extends BaseService
{
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
        parent::__construct($tag);
    }

    public function getAllData()
    {
        return $this->setValue(['id', 'name'])->getAllDatas();
    }

    public function storeData(Request $request)
    {
        try {
            $tag = $this->tag;

            $tag->name = $request->name;

            $tag->save();
        } catch (\Throwable $th) {
            return "Fail";
        }
        return "Success";
    }

    public function updateData(Request $request, $tagId)
    {
        try {
            $tag = $this->tag->findOrfail($tagId);

            $tag->name = $request->name;

            $tag->save();
        } catch (\Throwable $th) {
            return "Fail";
        }
        return "Success";
    }

    public function getData($tagId)
    {
        try {
            return $this->tag->findOrFail($tagId);
        } catch (\Throwable $th) {
            return "Data Tidak Ditemukan";
        }
    }

    public function deleteData($tagId)
    {
        try {
            $this->tag->destroy($tagId);
        } catch (\Throwable $th) {
            return "Fail";
        }
        return "Success";
    }
}
