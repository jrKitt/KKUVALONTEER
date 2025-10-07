<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index(){
        $user = User::all();
        $activity =  Activity::all();
        return view('owner.index',compact('user','activity'));
    }
}
