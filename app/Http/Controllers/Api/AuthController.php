<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\NewUserRegistered;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function register(RegisterRequest $request){
        // this is to create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // after create user, create access token for this user
        $token = $user->createToken('access_token');

        Mail::to($user)->queue(new NewUserRegistered($user));

        // then return user ID to use it in login or any thing else in application
        return response()->json([
            'id' => $user->id,
            'access_token'  => $token->plainTextToken
        ]);
    }

    public function login(LoginRequest $request){

        if(method_exists($this,'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->attemptLogin($request)){
            if(Auth::attempt($request->only(['email', 'password']))){
                $user = User::where([
                    'email' => $request->email
                ])->first();

                $user->tokens()->delete();
                $token = $user->createToken('access_token');
                return response()->json([
                    'id' => $user->id,
                    'access_token'  => $token->plainTextToken
                ]);
            } else{
                return response([
                    'error' => 'authentication filed'
                ], 403);
            }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }
}
