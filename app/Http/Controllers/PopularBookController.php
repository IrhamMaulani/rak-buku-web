<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;

class PopularBookController extends Controller
{
    private $bookService;


    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        return response()->json($this->bookService->syncAllScore());
    }

    public function update()
    {
        return response()->json($this->bookService->syncAllScore());
    }
}
