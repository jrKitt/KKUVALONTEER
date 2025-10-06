<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    //
    public function createActivity(Request $req) {
        $activity_name = $req->input("activity_name");
        error_log($activity_name);
        $new_activity = new Activity();
        $new_activity->name_th = $activity_name;
        $new_activity->description = $req->input("des");
        $new_activity->location = $req->input("location");
        $new_activity->accept_amount = 0;
        $new_activity->create_by = 0;
        $new_activity->save();
        return redirect("/admin/event");
    }
}
