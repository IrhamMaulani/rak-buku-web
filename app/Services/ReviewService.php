<?php

namespace App\Services;

use App\Book;
use App\User;
use App\Review;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class ReviewService extends BaseService
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
        $bookSlug = null;
        $orderBy = null;
        $order = null;
        $limit = 5;
        $userIncluded = null;
        $slug = null;

        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('search')) $search = $request->query('search');
        if ($request->has('bookSlug')) $bookSlug = $request->query('bookSlug');
        if ($request->has('order')) $order = $request->query('order');
        if ($request->has('limit')) $limit = $request->query('limit');
        if ($request->has('slug')) $slug = $request->query('slug');
        if ($request->has('userIncluded')) $userIncluded = $request->query('userIncluded');


        return  $this->setRelationship(['user.imageProfile', 'book:id,title,description,score,slug', 'selfResponse'])
            ->setScope('search', $search)->setScope('slug', $slug)->setScope('book', $bookSlug)->setScope('isUserIncluded', $userIncluded)->orderBy($orderBy, $order)->getDataPagination($limit);
    }

    public function addData(Request $request)
    {
        $bookId = $this->book->getIdBySlug($request->slug);

        $userId = $this->user->getAuthId();

        $slug = $request->title . ' ' . ' ' . $bookId . ' ' . $userId;

        try {
            $review = $this->review;
            $review->title = $request->title;
            $review->content = $request->content;
            $review->user_id = $userId;
            $review->book_id = $bookId;
            $review->slug = str_slug($slug, '-');

            $review->save();
        } catch (\Throwable $th) {
            return "Failed";
        }

        return "Success";
    }

    public function updateData(Request $request, $id)
    {

        try {
            $review = $this->review->findOrFail($id);
            $review->title = $request->title;
            $review->content = $request->content;
            $review->save();
        } catch (\Throwable $th) {
            return "Failed";
        }

        return "Success";
    }

    public function syncAllResponse()
    {
        $reviews =  DB::table('reviews')
            ->join('review_responses', 'reviews.id', '=', 'review_responses.review_id')
            ->select(
                'reviews.id',
                DB::raw("(SELECT COUNT(review_responses.is_like) FROM review_responses WHERE
                review_responses.review_id = reviews.id AND review_responses.is_like = 1 )
                as likes"),
                DB::raw("(SELECT COUNT(review_responses.is_like) FROM review_responses WHERE
                review_responses.review_id = reviews.id AND review_responses.is_like = 0 )
                as dislikes")
            )
            ->groupBy('reviews.id')
            ->get();

        try {
            foreach ($reviews as $review) {
                $reviewUpdate = $this->review->findOrFail($review->id);

                $reviewUpdate->likes = $review->likes;

                $reviewUpdate->dislikes = $review->dislikes;



                $reviewUpdate->save();
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        return "Success";
    }
}
