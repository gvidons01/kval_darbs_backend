<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

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
          'price' => 'required',
          'description' => 'required',
          'tr_type' => 'required',
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
        if(Ad::where('id', $id)->exists()){
          $ad = Ad::find($id);
          $ad->price = $request->price;
          $ad->description = $request->description;
          $ad->tr_type = $request->tr_type;

          $ad->save();
          return response()->json([
            "message" => "Ad updated successfully"
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
        if(Ad::where('id', $id)->exists()){
          $ad = Ad::find($id);
          $ad->delete();

          return response()->json([
            "message" => "Ad deleted"
          ], 202);
        }
        else{
          return response()->json([
            "message" => "Ad not found"
          ], 404);
        }
    }

    public function search($description)
    {
      return Ad::where('description', 'like', '%'.$description.'%')->get();
    }
}
