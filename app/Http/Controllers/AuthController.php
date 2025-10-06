<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'เข้าสู่ระบบสำเร็จ! ยินดีต้อนรับสู่ระบบผู้ดูแล');
            } else {
                return redirect()->intended('/dashboard')->with('success', 'เข้าสู่ระบบสำเร็จ!');
            }
        }

        return back()->withErrors([
            'email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
        ])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10',
            'faculty' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'year' => 'required|integer|min:1|max:4',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $uploadPath = public_path('uploads/profiles');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);
            $profileImagePath = $imageName;
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'year' => $request->year,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'major_id' => 1,
            'profile_image' => $profileImagePath,
        ]);

        Auth::login($user);

        // Since registration always creates 'student' role, redirect to student dashboard
        return redirect('/dashboard')->with('success', 'สมัครสมาชิกและเข้าสู่ระบบสำเร็จ!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}