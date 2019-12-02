<?php

namespace App\Services;

use App\Book;
use App\User;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreService extends BaseService
{
    private $score, $book;

    public function __construct(Score $score, Book $book)
    {
        $this->score = $score;
        $this->book = $book;
    }

    public function addScore(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $this->score->updateOrCreate(
                    ['user_id' => User::getAuthId(), 'book_id' => $request->book_id],
                    ['score' => $request->score]
                );
                $this->syncScore($request->book_id);
            });
        } catch (\Throwable $th) {
            return "Score Failed";
        }
        return "Score Successfull";
    }

    public function syncScore($bookId)
    {

        $numberOfUserScore = $this->score->whereBookId($bookId)->count();

        $averageAllBooks = $this->score->average('score');

        $averageThisBook = $this->score->whereBookId($bookId)->average('score');

        //Number for minimum score required for calculated. 10 user requried for this book calculated properly for now
        $minimumScore = 10;

        $score = ($numberOfUserScore / ($numberOfUserScore + $minimumScore) *
            $averageThisBook + ($minimumScore / ($numberOfUserScore + $minimumScore)) * $averageAllBooks);

        $bookUpdate = $this->book->findOrFail($bookId);

        $bookUpdate->score = $score;

        $bookUpdate->save();
    }

    public function syncAllScore()
    {
        $books = $this->book->get();

        try {
            foreach ($books as $book) {

                $numberOfUserScore = $this->score->whereBookId($book->id)->count();

                $averageAllBooks = $this->score->average('score');

                $averageThisBook = $this->score->whereBookId($book->id)->average('score');

                //Number for minimum score required for calculated. 10 user requried for this book calculated properly for now
                $minimumScore = 10;

                $score = ($numberOfUserScore / ($numberOfUserScore + $minimumScore) *
                    $averageThisBook + ($minimumScore / ($numberOfUserScore + $minimumScore)) * $averageAllBooks);

                $bookUpdate = $this->book->findOrFail($book->id);

                $bookUpdate->score = $score;

                $bookUpdate->favorites = $book->favorites;

                $bookUpdate->save();
            }
        } catch (\Throwable $th) {
            return 'failed';
        }
        return "Success";
    }
}
