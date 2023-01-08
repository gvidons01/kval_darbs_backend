<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\Report;
use App\Models\Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //update user info
    public function updateUser(Request $request){
        $request->validate([
            'fname' => 'string',
            'lname' => 'string',
            'phone_no' => 'string',
        ]);
        return [
            User::where('id', Auth::user()->id)->update($request->all()),
            response()->json([
                "message" => "User info updated!"
            ], 200)
        ];
    }

    //delete own user with all user's ads, reports to those ads, reports by user and access tokens
    public function deleteUser(Request $request){
        $ads = Ad::all()->where('user_id', '=', $request->user()->id);
        foreach ($ads as $ad){
            Report::where('ad_id', $ad->ID)->delete();
            Image::where('ad_id', $ad->ID)->delete();
        }
        Ad::where('user_id', '=', $request->user()->id)->delete();
        Report::where('user_id', '=', $request->user()->id)->delete();
        auth()->user()->tokens()->delete();
        $request->user()->delete();
        return response()->json([
            "message" => "User and its ads are deleted"
        ], 200);
    }

    //Change password, if user remembers the old one, but wants to change
    public function updatePassword(Request $request){
        $input = $request->all();
        $userid = Auth::user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:9|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }

    public function userInfo(Request $request){
        return $request->user();
    }
}
