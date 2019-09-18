<?php

namespace App\Http\Controllers;

use App\Reputation;
use Illuminate\Http\Request;
use App\Http\Resources\ReputationCollection;

class ReputationController extends Controller
{

    private $reputation;

    public function __construct(Reputation $reputation)
    {
        $this->reputation = $reputation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ReputationCollection($this->reputation->get());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reputation  $reputation
     * @return \Illuminate\Http\Response
     */
    public function show(Reputation $reputation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reputation  $reputation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reputation $reputation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reputation  $reputation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reputation $reputation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reputation  $reputation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reputation $reputation)
    {
        //
    }
}
