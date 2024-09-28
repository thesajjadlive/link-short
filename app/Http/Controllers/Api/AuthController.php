<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('mobile', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

        $token = auth()->attempt($credentials);
        if($token === false){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:6',
        ]);

        $exist = User::where('type','user')->where('email',$request->email)->first();
        if ($exist){
            return  $this->sendError('Error','Already registered with this email');
        }

        $new_user = new user();
        $slug = str_slug($request->name);
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->slug = $slug;
        $new_user->type = 'user';
        $new_user->status  = true;
        $new_user->password = Hash::make($request->password);
        $new_user->save();

        return $this->sendResponse('Success', 'Registration successfully done');
    }


    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }



}
