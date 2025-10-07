<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityParticipant;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function showAdminActivity(Request $request) {
    $rec = Activity::with('user')
    ->when($request->search, fn($q) => $q->where('name_th', 'like', "%{$request->search}%"))
    ->get();

    return view("admin/admin-event", compact("rec"));
}

   public function showUserActivity(Request $request) {
    $query = Activity::with('user')->orderBy('created_at', 'desc');

    if ($request->filled('search')) {
        $query->where('name_th', 'like', '%' . $request->search . '%');
    }

    $rec = $query->get();

     $user = User::find(auth()->id());

        $rec = $rec->filter(function ($activity) use ($user) {
            return $activity->user && $activity->user->faculty === $user->faculty;
        });


    if (auth()->check()) {
        $userRegistrations = ActivityParticipant::where('user_id', auth()->id())
            ->pluck('activity_id')
            ->toArray();

        foreach ($rec as $activity) {
            $activity->is_registered = in_array($activity->id, $userRegistrations);
            $activity->participants_count = $activity->participants()->count();
        }
    }

    return view("events", compact("rec"));
}


    //
    public function createActivity(Request $req) {
        $req->validate([
            'activity_name' => 'required|string|max:255',
            'des' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'accept_amount' => 'required|integer|min:1',
            'total_hour' => 'nullable|integer|min:0',
            'activity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
        ]);

    $new_activity = new Activity();
    $new_activity->name_th = $req->input('activity_name');
    $new_activity->description = $req->input('des');
    $new_activity->location = $req->input('location');
    $new_activity->start_time = $req->input('start_time');
    $new_activity->end_time = $req->input('end_time');
    $new_activity->accept_amount = $req->input('accept_amount');
    $new_activity->total_hour = $req->input('total_hour');
    $new_activity->create_by = auth()->id() ?? 0;
    $new_activity->status = 'pending';

    $tags = $req->input('tag', []);
    $new_activity->tags = json_encode($tags);

    if ($req->hasFile('activity_image')) {
        $file = $req->file('activity_image');
        $uploadPath = public_path('uploads/activities');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);
        $new_activity->image_file_name = $filename;
    }

    $new_activity->save();

    return redirect('/admin/event')->with('success', 'สร้างกิจกรรมเรียบร้อยแล้ว');
    }

    public function updateActivity(Request $req, $id)
    {
        $req->validate([
            'activity_name' => 'required|string|max:255',
            'des' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'accept_amount' => 'required|integer|min:1',
            'total_hour' => 'nullable|integer|min:0',
            'activity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
        ]);


        $activity = Activity::findOrFail($id);
        $activity->name_th = $req->input('activity_name');
        $activity->description = $req->input('des');
        $activity->location = $req->input('location');
        $activity->start_time = $req->input('start_time');
        $activity->end_time = $req->input('end_time');
        $activity->accept_amount = $req->input('accept_amount');
        $activity->total_hour = $req->input('total_hour');
        $activity->tags = json_encode($req->input('tags', []));

        if ($req->hasFile('activity_image')) {
            $file = $req->file('activity_image');
            $uploadPath = public_path('uploads/activities');
            if (!file_exists($uploadPath)) mkdir($uploadPath, 0777, true);
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            if ($activity->image_file_name) {
                $oldPath = public_path('uploads/activities/' . $activity->image_file_name);
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $activity->image_file_name = $filename;
        }

        $activity->save();

        return redirect('/admin/event')->with('success', 'อัปเดตกิจกรรมเรียบร้อยแล้ว');
    }

    public function registerActivity(Request $request) {
        try {
            $activityId = $request->input('activity_id');
            $userId = auth()->id();

            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'กรุณาเข้าสู่ระบบก่อน']);
            }

            $activity = Activity::find($activityId);
            if (!$activity) {
                return response()->json(['success' => false, 'message' => 'ไม่พบกิจกรรมนี้']);
            }

            if ($activity->status !== 'pending' && $activity->status !== 'ongoing') {
                return response()->json(['success' => false, 'message' => 'กิจกรรมนี้ปิดรับสมัครแล้ว']);
            }

            $existingRegistration = ActivityParticipant::where('activity_id', $activityId)
                ->where('user_id', $userId)
                ->first();

            if ($existingRegistration) {
                return response()->json(['success' => false, 'message' => 'คุณได้สมัครกิจกรรมนี้แล้ว']);
            }

            $currentParticipants = ActivityParticipant::where('activity_id', $activityId)->count();
            if ($currentParticipants >= $activity->accept_amount) {
                return response()->json(['success' => false, 'message' => 'กิจกรรมนี้เต็มแล้ว']);
            }

            $participant = ActivityParticipant::create([
                'activity_id' => $activityId,
                'user_id' => $userId,
                'status' => 'registered',
                'registered_at' => now()
            ]);

            if (!$participant) {
                return response()->json(['success' => false, 'message' => 'ไม่สามารถลงทะเบียนได้ กรุณาลองใหม่']);
            }

            return response()->json([
                'success' => true,
                'message' => 'ลงทะเบียนสำเร็จ',
                'activity' => $activity
            ]);
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในระบบ กรุณาลองใหม่อีกครั้ง'
            ]);
        }
    }

    public function getActivityDetail($id) {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json(['success' => false, 'message' => 'ไม่พบกิจกรรมนี้']);
        }

        return response()->json(['success' => true, 'activity' => $activity]);
    }

    public function showActivityDetail($id) {
        $activity = Activity::with('creator')->find($id);

        if (!$activity) {
            abort(404, 'ไม่พบกิจกรรมนี้');
        }

        if (auth()->check()) {
            $activity->is_registered = ActivityParticipant::where('activity_id', $id)
                ->where('user_id', auth()->id())
                ->exists();

            $activity->participants_count = ActivityParticipant::where('activity_id', $id)->count();
        }

        return view('detail', compact('activity'));
    }

    public function cancelRegistration(Request $request) {
        $activityId = $request->input('activity_id');
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'กรุณาเข้าสู่ระบบก่อน']);
        }

        $registration = ActivityParticipant::where('activity_id', $activityId)
            ->where('user_id', $userId)
            ->first();

        if (!$registration) {
            return response()->json(['success' => false, 'message' => 'ไม่พบการสมัครกิจกรรมนี้']);
        }


        $registration->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'message' => 'ยกเลิกการสมัครสำเร็จ'
        ]);
    }


    public function deleteActivity($id){
    $activity = Activity::findOrFail($id);


    if ($activity->image_file_name) {
        $path = public_path('uploads/activities/' . $activity->image_file_name);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $activity->delete();

    return redirect()->back()->with('success', 'ลบกิจกรรมเรียบร้อยแล้ว');
    }
}
