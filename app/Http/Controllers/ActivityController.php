<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    //
    public function createActivity(Request $req) {
        error_log($req->input("start_time"));
        $new_activity = new Activity();
        $new_activity->name_th = $req->input("activity_name");
        $new_activity->description = $req->input("des");
        $new_activity->location = $req->input("location");
        $new_activity->start_time = $req->input("start_time");
        $new_activity->end_time = $req->input("end_time");
        $new_activity->accept_amount = $req->input("accept_amount");
        $new_activity->total_hour = $req->input("total_hour");
        $new_activity->create_by = 0;
        $new_activity->save();
        return redirect("/admin/event");
    }
}
