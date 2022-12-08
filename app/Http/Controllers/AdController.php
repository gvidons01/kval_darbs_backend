<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Report;
use App\Models\User;
use App\Models\group;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdResource;

class AdController extends Controller
{
    /**
     * Display all ads.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAds($id)
    {
        return Ad::all()->where('subcat_id', $id);
    }

    /**
     * Store a newly created ad in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
          'price' => 'required|string',
          'description' => 'required|string',
          'tr_type' => 'required|string',
          'group_id' => 'required|integer|min:1|max:10',
          'category_id' => 'required|integer|min:1',
          'subcat_id' => 'required|integer|min:1',
        ]);
        $request['user_id'] = Auth::user()->id;
        $request['expires_at'] = now()->addDays(30); //Ads are active for 30 days
        return [
          Ad::create($request->all()),
          response()->json([
            "message" => "Ad created successfully!"
          ], 200)
        ];
    }

    /**
     * Display the specified ad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ad::find($id);
    }

    /**
     * Update the specified ad in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Ad::where('ID', '=', $id)->exists()){
          $ad = Ad::where('ID', '=', $id)->first();
          if($ad->user_id == Auth::user()->id){
            $request->validate([
              'price' => 'string',
              'description' => 'string',
              'tr_type' => 'integer',
            ]);
            $request['expires_at'] = now()->addDays(30); //Updating an ad resets expiry time
            Ad::where('ID', '=', $id)->update($request->all());
            return [
              response()->json([
                "message" => "Ad updated successfully"
              ], 200),
              Ad::find($id)
            ];
          }
          return response()->json([
            "message" => "Ad is not yours"
          ], 200);
          
        }

        else{
          return response()->json([
            "message" => "Ad not found"
          ], 404);
        }
    }

    /**
     * Remove the specified ad from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Ad::where('id', '=', $id)->exists()){
          $ad = Ad::where('ID', '=', $id)->first();
          if($ad->user_id == Auth::user()->id){
            if(Report::where('ad_id', '=', $id)->exists()){
              Report::where('ad_id', '=', $id)->delete();
            }
            Ad::where('id', '=', $id)->delete();
  
            return response()->json([
              "message" => "Ad and all its reports deleted"
            ], 202);
          }
          return response()->json([
            "message" => "Ad is not yours to delete"
          ], 202);
        }

        else{
          return response()->json([
            "message" => "Ad not found"
          ], 404);
        }
    }

    public function searchByText($description)
    {
      return Ad::select('description', 'price')
      ->join('')
      ->where('description', 'like', '%'.$description.'%')
      ->get();
    }

    //Display all ads created by the authenticated user
    public function showOwnAds(){
      if(Ad::where('user_id', '=', Auth::user()->id)->exists()){
        return Ad::select()
        ->where('user_id', '=', Auth::user()->id)
        ->groupBy('category_id');
      }
      return response()->json([
        "message" => "You don't have any ads yet!"
      ], 404);
    }
}
