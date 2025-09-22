<?php

namespace App\Http\Controllers;

use App\Models\VolunteerHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerHourController extends Controller
{
    public function index()
    {
        $volunteerHours = VolunteerHour::with('user')->where('user_id', Auth::id())->get();
        return view('volunteer-hours.index', compact('volunteerHours'));
    }

    public function create()
    {
        return view('volunteer-hours.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hours' => 'required|numeric|min:0.5|max:24',
            'date' => 'required|date|before_or_equal:today'
        ]);

        VolunteerHour::create([
            'user_id' => Auth::id(),
            'activity_name' => $request->activity_name,
            'description' => $request->description,
            'hours' => $request->hours,
            'date' => $request->date,
            'status' => 'pending'
        ]);

        return redirect()->route('volunteer-hours.index')
            ->with('success', 'บันทึกชั่วโมงจิตอาสาเรียบร้อยแล้ว');
    }

    public function show(VolunteerHour $volunteerHour)
    {
        if ($volunteerHour->user_id !== Auth::id()) {
            abort(403);
        }
        return view('volunteer-hours.show', compact('volunteerHour'));
    }

    public function edit(VolunteerHour $volunteerHour)
    {
        if ($volunteerHour->user_id !== Auth::id()) {
            abort(403);
        }
        return view('volunteer-hours.edit', compact('volunteerHour'));
    }

    public function update(Request $request, VolunteerHour $volunteerHour)
    {
        if ($volunteerHour->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'activity_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hours' => 'required|numeric|min:0.5|max:24',
            'date' => 'required|date|before_or_equal:today'
        ]);

        $volunteerHour->update($request->only(['activity_name', 'description', 'hours', 'date']));

        return redirect()->route('volunteer-hours.index')
            ->with('success', 'แก้ไขข้อมูลชั่วโมงจิตอาสาเรียบร้อยแล้ว');
    }

    public function destroy(VolunteerHour $volunteerHour)
    {
        if ($volunteerHour->user_id !== Auth::id()) {
            abort(403);
        }

        $volunteerHour->delete();

        return redirect()->route('volunteer-hours.index')
            ->with('success', 'ลบข้อมูลชั่วโมงจิตอาสาเรียบร้อยแล้ว');
    }
}
