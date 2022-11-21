<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
    * Create user
    * @param Request $Request
    * @return user
    */

    public function register(Request $request){
      try{
        //Validated
        $validateUser = Validator::make($request->all(),
        [
          'fname' => 'required|string',
          'lname' => 'required|string',
          'email' => 'required|email|unique:users,email',
          'phone_no'=> 'required|string|8',
          'password' => 'required|string|confirmed',
        ]);

        if($validateUser->fails()){
          return response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' => $validateUser->errors()
          ], 401);
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'user' => $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
      }
      catch (\Throwable $th) {
          return response()->json([
            'status' => false,
            'message' => $th->getMessage()
          ], 500);
      }
    }

    /**
    * Login The User
    * @param Request $request
    * @return User
    */
   public function login(Request $request){
      try {
        $validateUser = Validator::make($request->all(),
        [
            'email' => 'required|email',
           'password' => 'required|string'
        ]);

        if($validateUser->fails()){
            return response()->json([
               'status' => false,
               'message' => 'validation error',
               'errors' => $validateUser->errors()
           ], 401);
       }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Wrong email or password',
           ], 401);
        }

       $user = User::where('email', $request->email)->first();

       return response()->json([
           'status' => true,
           'message' => 'User Logged In Successfully',
           'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);

       }
       catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => $th->getMessage()
         ], 500);
       }
   }

   //Log out the user
   public function logout(Request $request){
    auth()->user()->tokens()->delete();
    return[
      response()->json([
        'message' => 'logged out'
      ]),
    ];
   }

}
