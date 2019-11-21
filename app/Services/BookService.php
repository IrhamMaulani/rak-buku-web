<?php

namespace App\Services;

use App\Book;

class BookService extends BaseService
{

    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
        parent::__construct($book);
    }

    public function getAllData($sortBy, $search, $pagination)
    {
        return  $this->setRelationship(['authors:id,name,pen_name', 'genres', 'score', 'checkBookmarked'])
            ->setSearch($search)->sortBy($sortBy)->getDataPagination($pagination);
    }
}
