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
        $bookmark = new Bookmark([
            'status' => $request->status,
            'is_owned' => $request->is_owned,
            'user_id' => User::getAuthId(),
            'book_id' => $request->book_id
        ]);

        if ($bookmark->save()) {
            return "BookMark Successfull";
        } else {
            return "BookMark Failed";
        }
    }
}
