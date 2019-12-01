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
    private $bookmark;

    public function __construct(Bookmark $bookmark)
    {
        $this->bookmark = $bookmark;
    }

    public function addBookMark(Request $request)
    {
        try {
            $this->bookmark->updateOrCreate(
                ['user_id' => User::getAuthId(), 'book_id' => $request->book_id],
                ['status' => $request->status]
            );
        } catch (\Throwable $th) {
            return "Bookmark Failed";
        }
        return "BookMark Successfull";
    }
}
