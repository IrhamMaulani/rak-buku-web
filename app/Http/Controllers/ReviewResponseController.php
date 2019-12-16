<?php

namespace App\Http\Controllers;

use App\Services\ReviewResponseService;
use Illuminate\Http\Request;

class ReviewResponseController extends Controller
{
    private $reviewResponseService;

    public function __construct(ReviewResponseService $reviewResponseService)
    {
        $this->reviewResponseService = $reviewResponseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->reviewResponseService->addLike($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReviewResponse  $reviewResponse
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReviewResponse  $reviewResponse
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReviewResponse  $reviewResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReviewResponse  $reviewResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
