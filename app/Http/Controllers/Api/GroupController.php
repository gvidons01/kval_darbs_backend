<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\group;
use App\Models\category;
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
}
