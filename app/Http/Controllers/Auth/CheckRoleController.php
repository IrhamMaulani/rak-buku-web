<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class CheckRoleController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function checkAdmin(Request $request)
    {
        if (User::getAuthId() === null) {
            return response()->json(false);
        }

        return response()->json(['admin' => $this->user->checkAdmin(User::getAuthId())]);
    }
}
