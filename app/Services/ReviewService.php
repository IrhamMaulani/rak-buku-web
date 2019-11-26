<?php

namespace App\Services;

use App\Review;
use Illuminate\Support\Facades\DB;

class ReviewService extends BaseService
{

    private $review;

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
                as dislikes"),
                DB::raw("(SELECT COUNT(review_responses.is_helpful) FROM review_responses WHERE
                review_responses.review_id = reviews.id AND review_responses.is_helpful = 1 )
                as helpful"),
                DB::raw("(SELECT COUNT(review_responses.is_helpful) FROM review_responses WHERE
                review_responses.review_id = reviews.id AND review_responses.is_helpful = 0 )
                as not_helpful")
            )
            ->groupBy('reviews.id')
            ->get();

        try {
            foreach ($reviews as $review) {
                $reviewUpdate = $this->review->findOrFail($review->id);

                $reviewUpdate->likes = $review->likes;

                $reviewUpdate->dislikes = $review->dislikes;

                $reviewUpdate->helpful = $review->helpful;

                $reviewUpdate->not_helpful = $review->not_helpful;

                $reviewUpdate->save();
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        return "Success";
    }
}
