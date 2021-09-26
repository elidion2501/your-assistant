<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * 
 * @group AUTH
 * 
 * @unauthenticated
 */
class AuthApiController extends Controller
{
    /**
     * POST sign up
     * 
     * @bodyParam email email required Email. Example:99999999@9999.99
     * @bodyParam password string required Password. Example:test1234
     * @bodyParam password_confirmation string required Password confirm. Example:test1234
     */
    public function signUp(SignUpRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;
        return response()->success(['token' => $token]);
    }

    /**
     * POST sign in
     * 
     * @bodyParam email string required Email. Example:woodrow.rolfson@example.com
     * @bodyParam password string required Password. Example:test1
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($data)) {
            return response()->error(['email' => 'Incorrect Details. Please try again'], 401);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response()->success(['token' => $token]);
    }

}
