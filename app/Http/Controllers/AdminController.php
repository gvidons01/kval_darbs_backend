<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ad;
use App\Models\Report;
use App\Models\Image;

class AdminController extends Controller
{
    //block or restore authorized access to one user
    public function changeUserAccess($id){
        if(Auth::user()->is_admin){
            $user=User::where('id', $id)->first();

            //Admins can't block other admins
            if($user->is_admin == '0'){
                if($user->is_blocked == '1'){
                    $user->is_blocked = '0';
                    $user->save();
                    return response()->json([
                        "message" => "User access is restored"
                    ], 200);
                }

                $user->is_blocked = '1';
                $user->save();
                return response()->json([
                    "message" => "User access is blocked"
                ], 200);
            }
            return response()->json([
                "message" => "You can't block another admin"
            ], 200);
            
        }
        return response()->json([
            'message' => 'You dont have admin permissions!'
        ], 200);
    }

    //View a list of ads which have at least 1 report
    public function viewReportedAds(){
        if(Auth::user()->is_admin){
            return Ad::all()->where(Report::where('ad_id', '=', 'Ad.id')->exists());
        }
        return response()->json([
            'message' => 'You dont have admin permissions!'
        ], 200);
    }

    //show all reports to one ad
    public function viewAdReports($id){
        if(Auth::user()->is_admin){
            if(Ad::where('id', '=', $id)->exists()){
                if(Report::where('ad_id', '=', $id)->exists()){
                  return Report::all()->where('ad_id', '=', $id);
                }
                return response()->json([
                    'message' => 'No reports found'
                ], 200);
            }
            return response()->json([
                'message' => 'No ad found'
            ], 200);
        }
        return response()->json([
            'message' => 'You dont have admin permissions!'
        ], 200);
    }

    //delete all reports for one ad
    public function deleteAdReports($id){
        if(Auth::user()->is_admin){
            if(Ad::where('id', '=', $id)->exists()){
                if(Report::where('ad_id', '=', $id)->exists()){
                    Report::where('ad_id', '=', $id)->delete();
                    return response()->json([
                        'message' => 'Reports deleted'
                    ], 200);
                }
            }
            return response()->json([
                'message' => 'No reports found'
            ], 200);
        }
        return response()->json([
            'message' => 'You dont have admin permissions!'
        ], 200);
    }

    //delete any ad with its reports
    public function deleteAnyAd($id){
        if(Auth::user()->is_admin){
            if(Ad::where('id', '=', $id)->exists()){
                if(Report::where('ad_id', '=', $id)->exists()){
                  Report::where('ad_id', '=', $id)->delete();
                }
                Image::where('ad_id', $id)->delete();
                Ad::where('id', '=', $id)->delete();
      
                return response()->json([
                  "message" => "Ad and all its reports deleted"
                ], 202);
            }
      
            else{
                return response()->json([
                  "message" => "Ad not found"
                ], 404);
            }
        }
        return response()->json([
            'message' => 'You dont have admin permissions!'
        ], 200);
    }

    //Show a list of users who are blocked from accessing the system
    public function showBlockedUsers(){
        if(Auth::user()->is_admin){
            return User::all()->where('is_blocked', '=', '1');
        }
        return response()->json([
            'message' => 'You dont have admin permissions!'
        ], 200);
    }
}
