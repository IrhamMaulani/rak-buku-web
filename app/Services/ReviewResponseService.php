<?php

namespace App\Services;

use App\User;
use App\Review;
use App\ReviewResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReviewResponseService extends BaseService
{
    private $review, $book;

    public function __construct(Review $review, ReviewResponse $reviewResponse)
    {
        $this->review = $review;
        $this->reviewResponse = $reviewResponse;
    }

    public function addLike(Request $request)
    {
        try {
            $reviewResponse =  $this->reviewResponse->firstOrCreate(
                ['user_id' => User::getAuthId(), 'review_id' => $request->review_id]
            );

            $reviewResponse->update($request->only(['is_like']));

            if (!is_null($request->is_like)) {

                $this->syncLikes($request->is_like, $request->review_id);
            }
        } catch (\Throwable $th) {
            return $th;
        }
        return "Successfull";
    }

    public function syncLikes($isLike, $reviewId)
    {
        $reviewLike = $this->reviewResponse->whereIsLike(1)->whereReviewId($reviewId)->count();
        $reviewDislike = $this->reviewResponse->whereIsLike(2)->whereReviewId($reviewId)->count();

        $review = $this->review->findOrFail($reviewId);

        $review->likes = $reviewLike;

        $review->dislikes = $reviewDislike;

        $review->save();
    }
}
