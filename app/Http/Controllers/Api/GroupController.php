<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\group;

class GroupController extends Controller
{
    //display all groups
    public function index(){
        return group::all();
    }
}
