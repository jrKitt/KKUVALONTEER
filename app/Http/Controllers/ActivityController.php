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
        $recs = Activity::all();
        error_log($recs);
        
        return redirect("/admin/event");
    }
}
