<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
{
    public function showReports($id){
        
    }

    public function reportAd(Request $request, $id){
        if(Ad::where('id', $id)->exists()){
            $request->validate([
                'reason' => 'required|string|max:255',
            ]);
            $request['ad_id'] = $id;
            $request['user_id'] = Auth::user()->id;
            $request['created_at'] = now();
            return [
                Report::create($request->all()),
                response()->json([
                    "message" => "Ad is reported!"
                ], 404),
            ];
        }
        return response()->json([
            "message" => "Ad not found"
          ], 404);
    }
}
