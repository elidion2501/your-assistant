<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    /**
     * handle user registration request
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
     * login user to our application
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. 
            Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);
    }


    /**
     * This method returns authenticated user details
     */
    public function authenticatedUserDetails()
    {
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }
}
