<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:10',
            'faculty' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'year' => 'required|integer|min:1|max:8',
        ]);

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'year' => $request->year,
        ]);

        return redirect()->route('profile.show')->with('success', 'อัพเดทโปรไฟล์สำเร็จ!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'เปลี่ยนรหัสผ่านสำเร็จ!');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }

        $fileName = time() . '_' . $user->id . '.' . $request->file('profile_image')->getClientOriginalExtension();
        $request->file('profile_image')->move(public_path('uploads/profiles'), $fileName);
        $path = 'uploads/profiles/' . $fileName;

        $user->update([
            'profile_image' => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'อัพเดทรูปโปรไฟล์สำเร็จ!',
            'image_url' => asset($path)
        ]);
    }

    public function deleteProfileImage()
    {
        $user = Auth::user();

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);

            $user->update([
                'profile_image' => null,
            ]);

            return redirect()->route('profile.show')->with('success', 'ลบรูปโปรไฟล์สำเร็จ!');
        }

        return redirect()->route('profile.show');
    }
}