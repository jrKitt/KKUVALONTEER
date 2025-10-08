<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityParticipant;
use App\Models\VolunteerHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkin page for a specific activity
     */
    public function show(Activity $activity)
    {
        if (!Auth::user()->isAdmin() && $activity->create_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $participants = ActivityParticipant::with('user')
            ->where('activity_id', $activity->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.activity-checkin', compact('activity', 'participants'));
    }


    public function checkin(Request $request, Activity $activity)
    {
        $request->validate([
            'participant_id' => 'required|exists:activity_participants,id',
            'actual_hours' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $participant = ActivityParticipant::findOrFail($request->participant_id);

        if ($participant->activity_id !== $activity->id) {
            return response()->json(['success' => false, 'message' => 'Invalid participant']);
        }

        DB::beginTransaction();
        try {
            $participant->update([
                'checked_in' => true,
                'checked_in_at' => now(),
                'checked_in_by' => Auth::id(),
                'actual_hours' => $request->actual_hours ?? $activity->total_hour,
                'checkin_notes' => $request->notes,
                'status' => 'completed'
            ]);



            $user = $participant->user;
            $activeGoals = $user->volunteerGoals()->active()->get();
            foreach ($activeGoals as $goal) {
                $goal->updateCurrentHours();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'เช็คชื่อเรียบร้อยแล้ว',
                'participant' => $participant->fresh()->load('user')
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }


    public function undoCheckin(Request $request, Activity $activity)
    {
        $request->validate([
            'participant_id' => 'required|exists:activity_participants,id',
        ]);

        $participant = ActivityParticipant::findOrFail($request->participant_id);

        if ($participant->activity_id !== $activity->id) {
            return response()->json(['success' => false, 'message' => 'Invalid participant']);
        }

        DB::beginTransaction();
        try {
            VolunteerHour::where('user_id', $participant->user_id)
                ->where('activity_name', $activity->name_th)
                ->where('date', $activity->start_time ? $activity->start_time->toDateString() : now()->toDateString())
                ->delete();

            $participant->update([
                'checked_in' => false,
                'checked_in_at' => null,
                'checked_in_by' => null,
                'actual_hours' => null,
                'checkin_notes' => null,
                'status' => 'registered'
            ]);

            $user = $participant->user;
            $activeGoals = $user->volunteerGoals()->active()->get();
            foreach ($activeGoals as $goal) {
                $goal->updateCurrentHours();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'ยกเลิกการเช็คชื่อเรียบร้อยแล้ว',
                'participant' => $participant->fresh()->load('user')
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }


    public function bulkCheckin(Request $request, Activity $activity)
    {
        $request->validate([
            'participant_ids' => 'required|array',
            'participant_ids.*' => 'exists:activity_participants,id',
            'actual_hours' => 'nullable|numeric|min:0'
        ]);

        $successCount = 0;
        $errors = [];

        DB::beginTransaction();
        try {
            foreach ($request->participant_ids as $participantId) {
                $participant = ActivityParticipant::find($participantId);

                if (!$participant || $participant->activity_id !== $activity->id) {
                    $errors[] = "Invalid participant ID: {$participantId}";
                    continue;
                }

                if ($participant->checked_in) {
                    $errors[] = "Participant {$participant->user->firstname} already checked in";
                    continue;
                }

                // Update participant
                $participant->update([
                    'checked_in' => true,
                    'checked_in_at' => now(),
                    'checked_in_by' => Auth::id(),
                    'actual_hours' => $request->actual_hours ?? $activity->total_hour,
                    'status' => 'completed'
                ]);

                // Create volunteer hour record
                VolunteerHour::create([
                    'user_id' => $participant->user_id,
                    'activity_name' => $activity->name_th,
                    'description' => "เข้าร่วมกิจกรรม: {$activity->name_th}",
                    'hours' => $request->actual_hours ?? $activity->total_hour,
                    'date' => $activity->start_time ? $activity->start_time->toDateString() : now()->toDateString(),
                    'status' => 'approved'
                ]);

                // Update goals
                $user = $participant->user;
                $activeGoals = $user->volunteerGoals()->active()->get();
                foreach ($activeGoals as $goal) {
                    $goal->updateCurrentHours();
                }

                $successCount++;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "เช็คชื่อสำเร็จ {$successCount} คน" . (!empty($errors) ? " (มีปัญหา " . count($errors) . " รายการ)" : ""),
                'success_count' => $successCount,
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }
}