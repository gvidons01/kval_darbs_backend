<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ad::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'price' => 'required|string',
          'description' => 'required|string',
          'tr_type' => 'required|integer',
        ]);
        return Ad::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ad::find($id);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
      return Ad::where('description', 'like', '%'.$description.'%')->get();
    }
}
