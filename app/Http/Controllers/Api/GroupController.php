<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\group;
use App\Models\category;
use App\Models\subcat;
use App\Models\Ad;
use App\Http\Resources\GroupResource;
use App\Http\Resources\CategoryResource;

class GroupController extends Controller
{
    //display all groups
    public function index(){
        return GroupResource::collection(group::all());
    }

    //display one group and its categories
    public function show($id){
        return [
            new GroupResource(group::findOrFail($id)),
            CategoryResource::collection(category::all()->where('group_id', '=', $id))
        ];
    }

    //display a category and its subcategories, if they exist, otherwise, show ads
    public function showSub($id){
        if(subcat::where('category_id', '=', $id)->exists()){
            return [
                new CategoryResource(category::findOrFail($id)),
                subcat::all()->where('category_id', '=', $id)
            ];
        }
        elseif(Ad::where('category_id', '=', $id)->exists()){
            return [
                new CategoryResource(category::findOrFail($id)),
                Ad::all()->where('category_id', '=', $id)
            ];
        }
        else{
            return response()->json([
                "message" => "no subcats or ads!!"
            ], 200);
        }
    }
}
