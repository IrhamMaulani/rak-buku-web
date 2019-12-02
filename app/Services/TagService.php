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
}
