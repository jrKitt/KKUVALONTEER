<?php

namespace App\Http\Controllers;

use App\Models\VolunteerHour;
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

        $upcomingEvents = [
            [
                'id' => 1,
                'title' => 'กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1',
                'description' => 'ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง จังหวัดขอนแก่น',
                'location' => 'นาหลังบ้านนายเอกรินทร์',
                'date' => '8 พ.ย. 2568',
                'hours' => '30 ชั่วโมง',
                'image' => 'carousel_1.jpg',
                'tags' => ['#เกษตรศาสตร์', 'ปี 1-4']
            ],
            [
                'id' => 2,
                'title' => 'มือดีกิจกรรมดี เราสร้างความสุข',
                'description' => 'กิจกรรมสร้างสรรค์เพื่อชุมชน ร่วมกันทำกิจกรรมที่เป็นประโยชน์ต่อสังคม',
                'location' => 'ศูนย์ชุมชนเทศบาลเมือง',
                'date' => '15 พ.ย. 2568',
                'hours' => '20 ชั่วโมง',
                'image' => 'carousel_2.jpg',
                'tags' => ['#ชุมชน', 'ปี 2-4']
            ],
            [
                'id' => 3,
                'title' => 'รองเท้าคู่แรกสร้างชีวิต',
                'description' => 'โครงการช่วยเหลือเด็กด้อยโอกาส มอบรองเท้าและความรู้แก่น้องๆ',
                'location' => 'โรงเรียนบ้านนาใต้',
                'date' => '22 พ.ย. 2568',
                'hours' => '15 ชั่วโมง',
                'image' => 'carousel_3.jpg',
                'tags' => ['#การศึกษา', 'ทุกปี']
            ]
        ];

        return view('dashboard', compact('totalHours', 'approvedHours', 'pendingHours', 'rejectedHours', 'recentActivities', 'upcomingEvents'));
    }
}
