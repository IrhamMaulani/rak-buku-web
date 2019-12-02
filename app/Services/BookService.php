<?php

namespace App\Services;

use App\Book;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookService extends BaseService
{

    private $book, $score;

    public function __construct(Book $book, Score $score)
    {
        $this->book = $book;
        $this->score = $score;
        parent::__construct($book);
    }

    public function getAllData(Request $request)
    {
        $search = null;
        $tag = null;
        $orderBy = null;
        $order = null;
        $limit = 5;

        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('tag')) $tag = $request->query('tag');
        if ($request->has('order')) $order = $request->query('order');
        if ($request->has('limit')) $limit = $request->query('limit');

        return  $this->setRelationship(['authors:id,name,pen_name', 'tags:id,name', 'checkBookmarked', 'bookImagesCover', 'publisher:id,name'])
            ->setScope('search', $search)->setScope('tag', $tag)->orderBy($orderBy, $order)->getDataPagination($limit);
    }

    public function getData($slug)
    {

        return $this->book->with(['authors:id,name,pen_name', 'tags:id,name', 'checkBookmarked', 'bookImagesCover', 'publisher:id,name', 'userScore'])
            ->whereSlug($slug)->first();
    }

    public function addData(Request $request)
    { }
}
