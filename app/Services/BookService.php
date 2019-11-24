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

    public function getAllData($sortBy, $search, $tag, $pagination)
    {
        return  $this->setRelationship(['authors:id,name,pen_name', 'tags:id,name', 'score', 'checkBookmarked', 'bookImagesCover'])
            ->setScope('search', $search)->setScope('tag', $tag)->sortBy($sortBy)->getDataPagination($pagination);
    }
}
