<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\group;
use App\Models\category;

class GroupController extends Controller
{
    //display all groups
    public function index(){
        return group::all();
    }

    //display one group and its categories
    /*public function show($id){
        return [
          group::find($id);
          category::all()->where('group_id', '=', $id);
        ];
    }*/
}
