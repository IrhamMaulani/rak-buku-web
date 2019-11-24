<?php

namespace App\Services;

use App\Review;

class ReviewService extends BaseService
{

    private $book;

    public function __construct(Review $review)
    {
        $this->review = $review;
        parent::__construct($review);
    }

    public function getAllData($sortBy, $search, $tag, $pagination)
    {
        return  $this->setRelationship(['user', 'book'])
            ->setScope('search', $search)->setScope('tag', $tag)->sortBy($sortBy)->getDataPagination($pagination);
    }
}
