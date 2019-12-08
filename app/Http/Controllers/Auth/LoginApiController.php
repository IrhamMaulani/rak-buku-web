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



class LoginApiController extends Controller
{
    private $successStatus = 200;

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only($this->username(), 'password');

        // dd($credentials);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Your email or password was incorrect. Please try again!'
            ], 401);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user' => ['id' => $user->id, 'user_name' => $user->name],
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


    public function username()
    {
        return 'email';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }
     public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'old_password'=> 'required',
         'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
    ]);
        if ($validator->fails()) {
            return response()->json([
            'message' => 'Failed Change Password',
            'error' => $validator->errors()
        ], 422);
        }
        $userId = User::getAuthId();
        $user = User::findOrFail($userId);
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
            'message' => 'Password Lama Salah'
        ]);
        }
        $user->password = $request->password;
        $user->save();
        if ($user) {
            return response()->json([
            'message' => 'Password Sukses Di Ubah'
        ]);
        } else {
            return response()->json([
            'message' => 'Terjadi Kesalahan. Coba Lagi'
        ]);
        }
    }
}
