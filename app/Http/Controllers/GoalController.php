<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VolunteerGoal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $user->volunteerGoals()->get()->each(function($goal) {
            $goal->updateCurrentHours();
        });

        $activeGoals = $user->volunteerGoals()->active()->current()->get();
        $completedGoals = $user->volunteerGoals()->where('is_achieved', true)->latest()->take(5)->get();
        $overdueGoals = $user->volunteerGoals()->active()->get()->filter(function($goal) {
            return $goal->is_overdue;
        });

        $recentActivities = \DB::table('activity_participants')
            ->join('activities', 'activity_participants.activity_id', '=', 'activities.id')
            ->where('activity_participants.user_id', $user->id)
            ->where('activity_participants.status', '!=', 'cancelled')
            ->select(
                'activities.*',
                'activity_participants.status as registration_status',
                'activity_participants.checked_in',
                'activity_participants.checked_in_at',
                'activity_participants.actual_hours',
                'activity_participants.created_at as participation_created_at'
            )
            ->orderBy('activity_participants.created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($activity) {
                return (object) [
                    'id' => $activity->id,
                    'name' => $activity->name_th,
                    'status' => $activity->checked_in ? 'checked_in' : $activity->registration_status,
                    'checked_in' => $activity->checked_in,
                    'checked_in_at' => $activity->checked_in_at,
                    'actual_hours' => $activity->actual_hours ?? $activity->total_hour,
                    'total_hours' => $activity->total_hour,
                    'start_time' => $activity->start_time
                ];
            });

        return view('goals.index', compact('activeGoals', 'completedGoals', 'overdueGoals', 'recentActivities'));
    }

    public function create()
    {
        $goalTypes = [
            'personal' => 'เป้าหมายส่วนตัว',
            'academic' => 'เป้าหมายตามหลักสูตร',
            'faculty' => 'เป้าหมายตามคณะ',
            'custom' => 'เป้าหมายกำหนดเอง'
        ];

        $periodTypes = [
            'academic_year' => 'ปีการศึกษา',
            'semester' => 'ภาคเรียน',
            'monthly' => 'รายเดือน',
            'custom' => 'กำหนดเอง'
        ];

        $activityTags = \App\Models\Activity::whereNotNull('tags')
            ->pluck('tags')
            ->map(function ($tags) {
                if (is_string($tags)) {
                    return json_decode($tags, true) ?: [];
                }
                return is_array($tags) ? $tags : [];
            })
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        $categories = $activityTags->mapWithKeys(function ($tag) {
            return [$tag => $tag];
        })->toArray();

        if (empty($categories)) {
            $categories = [
                'คณะบริหารธุรกิจและการบัญชี' => 'คณะบริหารธุรกิจและการบัญชี',
                'คณะศึกษาศาสตร์' => 'คณะศึกษาศาสตร์',
                'วิทยาลัยการคอมพิวเตอร์' => 'วิทยาลัยการคอมพิวเตอร์',
                'กิจกรรมทั่วไป' => 'กิจกรรมทั่วไป'
            ];
        }

        return view('goals.create', compact('goalTypes', 'periodTypes', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal_type' => 'required|string',
            'target_hours' => 'required|numeric|min:1',
            'period_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category' => 'nullable|string',
            'description' => 'nullable|string|max:500'
        ]);

        $goal = VolunteerGoal::create([
            'user_id' => Auth::id(),
            'goal_type' => $request->goal_type,
            'target_hours' => $request->target_hours,
            'period_type' => $request->period_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        $goal->updateCurrentHours();

        return redirect()->route('goals.index')->with('success', 'สร้างเป้าหมายเรียบร้อยแล้ว!');
    }

    public function show(VolunteerGoal $goal)
    {
        $this->authorize('view', $goal);

        $goal->load('user');
        $relatedHours = $goal->user->volunteerHours()
            ->whereBetween('date', [$goal->start_date, $goal->end_date])
            ->orderBy('date', 'desc')
            ->get();

        return view('goals.show', compact('goal', 'relatedHours'));
    }

    public function edit(VolunteerGoal $goal)
    {
        $this->authorize('update', $goal);

        $goalTypes = [
            'personal' => 'เป้าหมายส่วนตัว',
            'academic' => 'เป้าหมายตามหลักสูตร',
            'faculty' => 'เป้าหมายตามคณะ',
            'custom' => 'เป้าหมายกำหนดเอง'
        ];

        $periodTypes = [
            'academic_year' => 'ปีการศึกษา',
            'semester' => 'ภาคเรียน',
            'custom' => 'กำหนดเอง'
        ];

        $activityTags = \App\Models\Activity::whereNotNull('tags')
            ->pluck('tags')
            ->map(function ($tags) {
                if (is_string($tags)) {
                    return json_decode($tags, true) ?: [];
                }
                return is_array($tags) ? $tags : [];
            })
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        $categories = $activityTags->mapWithKeys(function ($tag) {
            return [$tag => $tag];
        })->toArray();

        if (empty($categories)) {
            $categories = [
                'คณะบริหารธุรกิจและการบัญชี' => 'คณะบริหารธุรกิจและการบัญชี',
                'คณะศึกษาศาสตร์' => 'คณะศึกษาศาสตร์',
                'วิทยาลัยการคอมพิวเตอร์' => 'วิทยาลัยการคอมพิวเตอร์',
                'กิจกรรมทั่วไป' => 'กิจกรรมทั่วไป'
            ];
        }

        return view('goals.edit', compact('goal', 'goalTypes', 'periodTypes', 'categories'));
    }

    public function update(Request $request, VolunteerGoal $goal)
    {
        $this->authorize('update', $goal);

        $request->validate([
            'goal_type' => 'required|string',
            'target_hours' => 'required|numeric|min:1',
            'period_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category' => 'nullable|string',
            'description' => 'nullable|string|max:500'
        ]);

        $goal->update($request->only([
            'goal_type', 'target_hours', 'period_type',
            'start_date', 'end_date', 'category', 'description'
        ]));

        $goal->updateCurrentHours();

        return redirect()->route('goals.show', $goal)->with('success', 'อัพเดตเป้าหมายเรียบร้อยแล้ว!');
    }

    public function destroy(VolunteerGoal $goal)
    {
        $this->authorize('delete', $goal);

        $goal->delete();

        return redirect()->back()->with('success', 'เป้าหมายถูกลบเรียบร้อยแล้ว');
    }

    public function updateProgress()
    {
        $user = Auth::user();

        $goals = $user->volunteerGoals()->get();

        foreach ($goals as $goal) {
            $goal->updateCurrentHours();
        }

        return response()->json([
            'success' => true,
            'message' => 'Progress updated successfully',
            'updated_goals' => $goals->count()
        ]);
    }

    public function completeGoal(VolunteerGoal $goal)
    {
        $this->authorize('update', $goal);

        if ($goal->current_hours >= $goal->target_hours) {
            $goal->update([
                'is_achieved' => true,
                'achieved_at' => Carbon::now(),
                'is_active' => false
            ]);

            return redirect()->back()->with('success', 'เป้าหมายเสร็จสิ้นเรียบร้อยแล้ว! คุณสามารถดาวน์โหลดเอกสารรับรองได้');
        }

        return redirect()->back()->with('error', 'ยังไม่สามารถเสร็จสิ้นเป้าหมายได้ เนื่องจากชั่วโมงยังไม่ครบตามเป้าหมาย');
    }

    public function generateCertificate(VolunteerGoal $goal)
    {
        $this->authorize('view', $goal);

        if (!$goal->is_achieved) {
            return redirect()->back()->with('error', 'ไม่สามารถออกเอกสารรับรองได้ เนื่องจากเป้าหมายยังไม่เสร็จสิ้น');
        }

        $user = $goal->user;

        return view('goals.certificate', compact('goal', 'user'));
    }
}
