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

    public function getPopularBook()
    {
        return $this->setRelationship(['scores'])->getDataPagination(10);
    }

    public function syncAllScore()
    {

        $books =  DB::table('books')
            ->join('scores', 'books.id', '=', 'scores.book_id')
            ->select(
                'books.id',
                DB::raw('sum(scores.score)as score'),
                DB::raw('count(scores.user_id)as user_count'),
                DB::raw("(SELECT COUNT(scores.is_favorite) FROM scores WHERE
                scores.book_id = books.id AND scores.is_favorite = 1 )
                as favorites")
            )
            ->groupBy('books.id')
            ->get();

        try {
            foreach ($books as $book) {
                $bookUpdate = $this->book->findOrFail($book->id);

                $bookUpdate->score = ($book->score / $book->user_count);

                $bookUpdate->favorites = $book->favorites;

                $bookUpdate->save();
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        return "Success";
    }
}
