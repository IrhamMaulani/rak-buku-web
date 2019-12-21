<?php

namespace App\Services;

use App\Book;
use App\User;
use App\Review;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class UserhaveReviewService extends BaseService
{

    private $review, $book, $user;

    public function __construct(Review $review, Book $book, User $user)
    {
        $this->review = $review;
        $this->book = $book;
        $this->user = $user;
        parent::__construct($review);
    }

    public function getAllData(Request $request)
    {
        $search = null;
        $order = null;
        $limit = 5;
        $orderBy = null;

        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('order')) $order = $request->query('order');
        if ($request->has('limit')) $limit = $request->query('limit');


        return  $this->setRelationship(['user.imageProfile', 'book:id,title,description,score,slug', 'selfResponse'])
            ->setScope('search', $search)->setCondition('user_id', '=', $this->user->getAuthId())
            ->orderBy($orderBy, $order)->getDataPagination($limit);
    }
}
