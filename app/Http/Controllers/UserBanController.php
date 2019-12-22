<?php

namespace App\Http\Controllers;

use App\Services\UserBanService;
use Illuminate\Http\Request;

class UserBanController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, UserBanService $userBanService)
    {
        return response()->json($userBanService->updateBan($request->statusBan, $userId));
    }
}
