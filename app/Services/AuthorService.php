<?php

namespace App\Services;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorService extends BaseService
{

    private $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
        parent::__construct($author);
    }

    public function getAllData(Request $request)
    {
        $search = null;
        $orderBy = null;
        $order = null;


        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('order')) $order = $request->query('order');

        return  $this->setScope('search', $search)->setValue(['id', 'name', 'pen_name'])
            ->orderBy($orderBy, $order)->getAllDatas();
    }
}
