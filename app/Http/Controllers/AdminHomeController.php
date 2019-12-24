<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $bookCount = Book::get()->count();

        $userCount = User::get()->count();

        $authorCount = Author::get()->count();

        return response()->json(['book_count' => $bookCount, 'user_count' => $userCount, 'author_count' => $authorCount]);
    }
}
