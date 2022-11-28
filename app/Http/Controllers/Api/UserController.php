<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\Report;

class UserController extends Controller
{
    //update user info
    public function updateUser(Request $request){

    }

    //delete own user with all ads, reports and access tokens
    public function deleteUser(Request $request){
        Ad::where('user_id', '=', $request->user()->id)->delete();
        Report::where('user_id', '=', $request->user()->id)->delete();
        auth()->user()->tokens()->delete();
        $request->user()->delete();
        return response()->json([
            "message" => "User and its ads are deleted"
        ], 200);
    }

    public function resetPassword(Request $request){
        
    }

    public function userInfo(Request $request){
        return $request->user();
    }
}
