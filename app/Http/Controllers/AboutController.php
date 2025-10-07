<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $registeredActivities = DB::table('activity_participants')
            ->join('activities', 'activity_participants.activity_id', '=', 'activities.id')
            ->where('activity_participants.user_id', $user->id)
            ->where('activity_participants.status', '!=', 'cancelled')
            ->select(
                'activities.*',
                'activity_participants.status as registration_status',
                'activity_participants.registered_at',
                'activity_participants.created_at as participation_created_at'
            )
            ->orderBy('activity_participants.created_at', 'desc')
            ->get();

        $totalHours = $registeredActivities->sum('total_hour');
        $completedHours = $registeredActivities->where('registration_status', 'completed')->sum('total_hour');
        $ongoingHours = $registeredActivities->where('registration_status', 'registered')->sum('total_hour');

        $userActivities = $registeredActivities->map(function ($activity) {

            $progress = 0;
            if ($activity->registration_status === 'completed') {
                $progress = 100;
            } elseif ($activity->registration_status === 'registered') {
                $startDate = \Carbon\Carbon::parse($activity->start_time);
                $endDate = \Carbon\Carbon::parse($activity->end_time);
                $now = \Carbon\Carbon::now();

                if ($now->greaterThan($endDate)) {
                    $progress = 100;
                } elseif ($now->greaterThan($startDate)) {
                    $totalDuration = $endDate->diffInHours($startDate);
                    $elapsed = $now->diffInHours($startDate);
                    $progress = $totalDuration > 0 ? min(100, ($elapsed / $totalDuration) * 100) : 0;
                }
            }

            return (object) [
                'id' => $activity->id,
                'name' => $activity->name_th,
                'description' => $activity->description,
                'location' => $activity->location ?? 'มหาวิทยาลัยขอนแก่น',
                'start_date' => \Carbon\Carbon::parse($activity->start_time),
                'end_date' => $activity->end_time ? \Carbon\Carbon::parse($activity->end_time) : null,
                'total_hours' => $activity->total_hour ?? 0,
                'completed_hours' => $activity->registration_status === 'completed' ? ($activity->total_hour ?? 0) : 0,
                'status' => $activity->registration_status,
                'progress' => round($progress),
                'image_file_name' => $activity->image_file_name,
                'tags' => ($activity->tags && is_array($activity->tags)) ? array_map(function($tag) { return '#' . $tag; }, $activity->tags) : ['#กิจกรรมอาสา']
            ];
        });

        return view('about-us', compact('totalHours', 'completedHours', 'ongoingHours', 'userActivities'));
    }
}
