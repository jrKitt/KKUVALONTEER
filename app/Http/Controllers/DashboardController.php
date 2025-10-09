<?php

namespace App\Http\Controllers;

use App\Models\VolunteerHour;
use App\Models\Activity;
use App\Models\ActivityParticipant;
use App\Models\VolunteerGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $registeredActivities = DB::table('activity_participants')
            ->join('activities', 'activity_participants.activity_id', '=', 'activities.id')
            ->where('activity_participants.user_id', $user->id)
            ->select(
                'activities.*',
                'activity_participants.status as registration_status',
                'activity_participants.registered_at',
                'activity_participants.created_at as participation_created_at',
                'activity_participants.checked_in',
                'activity_participants.checked_in_at',
                'activity_participants.actual_hours'
            )
            ->orderBy('activity_participants.created_at', 'desc')
            ->get();

        $totalHours = $registeredActivities->where('registration_status', '!=', 'cancelled')->sum('total_hour');
        $approvedHours = $registeredActivities->where('checked_in', true)->sum(function($activity) {
            return $activity->actual_hours ?? $activity->total_hour;
        });
        $pendingHours = $registeredActivities->where('registration_status', 'registered')->where('checked_in', false)->sum('total_hour');
        $rejectedHours = $registeredActivities->where('registration_status', 'cancelled')->sum('total_hour');

        $recentActivities = $registeredActivities->take(6)->map(function ($activity) {
            $actualStatus = $activity->registration_status;
            $actualHours = $activity->total_hour ?? 0;

            if ($activity->checked_in) {
                $actualStatus = 'checked_in';
                $actualHours = $activity->actual_hours ?? $activity->total_hour;
            }

            return (object) [
                'id' => $activity->id,
                'activity_name' => $activity->name_th,
                'description' => $activity->description,
                'location' => $activity->location,
                'date' => \Carbon\Carbon::parse($activity->start_time),
                'hours' => $actualHours,
                'status' => $actualStatus,
                'image_file_name' => $activity->image_file_name,
                'tags' => ($activity->tags && is_array($activity->tags)) ? array_map(function($tag) { return '#' . $tag; }, $activity->tags) : ['#กิจกรรมจิตอาสา'],
                'checked_in' => $activity->checked_in ?? false,
                'checked_in_at' => $activity->checked_in_at
            ];
        });

        $upcomingEvents = Activity::where('status', '!=', 'finished')
            ->where('start_time', '>', now())
            ->orderBy('start_time', 'asc')
            ->take(6)
            ->get()
            ->map(function ($activity) use ($user) {
                $participantCount = ActivityParticipant::where('activity_id', $activity->id)->count();
                $isRegistered = ActivityParticipant::where('activity_id', $activity->id)
                    ->where('user_id', $user->id)
                    ->exists();

                return [
                    'id' => $activity->id,
                    'title' => $activity->name_th,
                    'description' => $activity->description,
                    'location' => $activity->location ?? 'มหาวิทยาลัยขอนแก่น',
                    'date' => $activity->start_time ? $activity->start_time->format('d M Y') : 'ไม่ระบุ',
                    'hours' => ($activity->total_hour ?? 0) . ' ชั่วโมง',
                    'image' => $activity->image_file_name ? "uploads/activities/" . $activity->image_file_name : "carousel_1.jpg",
                    'tags' => ($activity->tags && is_array($activity->tags)) ? array_map(function($tag) { return '#' . $tag; }, $activity->tags) : ['#กิจกรรมอาสา'],
                    'can_register' => !$isRegistered && $participantCount < $activity->accept_amount,
                    'is_registered' => $isRegistered,
                    'is_full' => $participantCount >= $activity->accept_amount
                ];
            });

        $currentGoals = $user->volunteerGoals()
            ->active()
            ->current()
            ->with('user')
            ->get()
            ->map(function($goal) {
                $goal->updateCurrentHours();
                return $goal;
            });

        $goalProgress = null;
        if ($currentGoals->count() > 0) {
            $activeGoal = $currentGoals->first();
            $goalProgress = [
                'goal' => $activeGoal,
                'progress' => $activeGoal->progress_percentage,
                'remaining' => $activeGoal->remaining_hours,
                'days_left' => $activeGoal->days_remaining,
                'is_overdue' => $activeGoal->is_overdue,
                'total_goals' => $user->volunteerGoals()->count(),
                'completed_goals' => $user->volunteerGoals()->where('is_achieved', true)->count()
            ];
        }

        return view('dashboard', compact(
            'totalHours',
            'approvedHours',
            'pendingHours',
            'rejectedHours',
            'recentActivities',
            'upcomingEvents',
            'currentGoals',
            'goalProgress'
        ));
    }
}
