<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScoreService;

class PopularBookController extends Controller
{
    private $scoreService;


    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    public function index(Request $request)
    {
        return response()->json($this->scoreService->syncAllScore());
    }

    public function update()
    {
        return response()->json($this->scoreService->syncAllScore());
    }
}
