<?php

namespace App\Services;

use App\Book;
use App\User;
use App\Score;
use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookMarkService extends BaseService
{
    private $bookmark, $book;

    public function __construct(Bookmark $bookmark, Book $book)
    {
        $this->bookmark = $bookmark;
        $this->book = $book;
    }

    public function getAllData(Request $request)
    {

        $status = null;
        $limit = 6;
        $isOwned = null;
        $isFavorite = null;
        if ($request->has('status')) $status = $request->query('status');
        if ($request->has('limit')) $limit = $request->query('limit');
        if ($request->has('isOwned')) $isOwned = $request->query('isOwned');
        if ($request->has('isFavorite')) $isFavorite = $request->query('isFavorite');

        return  $this->book->whereHas('checkBookmarked', function ($query)  use ($status, $isOwned, $isFavorite) {
            if (!is_null($status)) {
                $query->whereStatus($status);
            }
            if (!is_null($isOwned)) {
                $query->whereIsOwned($isOwned);
            }
            if (!is_null($isFavorite)) {
                $query->whereIsFavorite($isFavorite);
            }
        })->with(['checkBookmarked', 'userScore', 'authors', 'bookImagesCover'])->orderBy('created_at', 'asc')->paginate($limit);
    }

    public function addBookMark(Request $request)
    {
        try {
            $bookmark =  $this->bookmark->firstOrCreate(
                ['user_id' => User::getAuthId(), 'book_id' => $request->book_id]
            );

            $bookmark->update($request->only(['status', 'is_owned', 'is_favorite']));

            if (!is_null($request->is_favorite)) {

                $this->syncFavorite($request->book_id);
            }
        } catch (\Throwable $th) {
            return "Bookmark Failed";
        }
        return "BookMark Successfull";
    }

    public function syncFavorite($bookId)
    {
        $bookmarkFavorite = $this->bookmark->whereIsFavorite(1)->whereBookId($bookId)->count();

        $book = $this->book->findOrFail($bookId);

        $book->favorites = $bookmarkFavorite;
        $book->save();
    }
}
