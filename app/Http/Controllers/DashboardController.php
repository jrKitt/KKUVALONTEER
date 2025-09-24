<?php

namespace App\Http\Controllers;

use App\Models\VolunteerHour;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $volunteerHours = VolunteerHour::where('user_id', $user->id)->get();

        $totalHours = $volunteerHours->sum('hours');
        $approvedHours = $volunteerHours->where('status', 'approved')->sum('hours');
        $pendingHours = $volunteerHours->where('status', 'pending')->sum('hours');
        $rejectedHours = $volunteerHours->where('status', 'rejected')->sum('hours');
        $recentActivities = $volunteerHours->sortByDesc('created_at')->take(6);

        // ดึงข้อมูลกิจกรรมจากฐานข้อมูลแบบสุ่ม 3 รายการ
        $upcomingEvents = Event::where('is_active', true)
                              ->inRandomOrder()
                              ->take(3)
                              ->get();

        return view('dashboard', compact('totalHours', 'approvedHours', 'pendingHours', 'rejectedHours', 'recentActivities', 'upcomingEvents'));
    }
}
