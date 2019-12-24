<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;
use App\Services\PublisherService;

class PublisherController extends Controller
{
    private $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->publisherService->getAllData($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->publisherService->addData($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show($publisherId)
    {
        return response()->json($this->publisherService->getData($publisherId));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $publisherId)
    {
        return response()->json($this->publisherService->updateData($request, $publisherId));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy($publisherId)
    {
        return response()->json($this->publisherService->deleteData($publisherId));
    }
}
