<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewResponseProcessController extends Controller
{
    private $reviewService;


    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Request $request)
    {
        return response()->json($this->reviewService->syncAllResponse());
    }
}
