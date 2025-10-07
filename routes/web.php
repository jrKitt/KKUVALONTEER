<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VolunteerHourController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OwnerController;
use Illuminate\Routing\RouteRegistrar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');

Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');

Route::get('/index', function () {
    return view('index');
});
Route::get('/event', function () {
    return view('event');
});
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/detail', function () {
    return view('valunteerdetails');
});
Route::get('/owner',[OwnerController::class,'index']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('volunteer-hours', VolunteerHourController::class);

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/image', [ProfileController::class, 'updateProfileImage'])->name('profile.image.update');
    Route::delete('/profile/image', [ProfileController::class, 'deleteProfileImage'])->name('profile.image.delete');
});

Route::get('/admin/dashboard' , function(){
    return view('admin/admin-dashboard');
})->name('admin.dashboard');



Route::get('/admin' , function(){
    return view('admin/index');
});

Route::get('/admin/checkin', function() {
    $event = (object) [
        'id' => 1,
        'title' => 'กิจกรรมชวนน้องดำนาครั้งที่ 1',
        'description' => 'อ้ายนี่ล่ะผัวน้อง',
        'location' => 'นาข้าวบ้านหนองแสง ตำบลหนองแสง อำเภอเมือง จังหวัดขอนแก่น',
        'date' => '2024-09-19',
        'hours' => 8,
        'image' => '/images/rice-field.jpg',
        'tags' => ['จิตอาสา', 'เกษตรกรรม', 'ชุมชน']
    ];

    $participants = collect([
        (object) [
            'id' => 1,
            'firstname' => 'สมชาย',
            'lastname' => 'ใจดี',
            'faculty' => 'คณะวิศวกรรมศาสตร์',
            'major' => 'วิศวกรรมคอมพิวเตอร์',
            'year' => 2,
            'avatar' => null,
            'pivot' => (object) ['checked_in' => false],
            'volunteer_hours' => collect([(object) ['hours' => 12]])
        ]
    ]);

    return view('admin.checkin-simple', compact('event', 'participants'));
})->name('admin.checkin');


Route::get('/admin/event' , [ActivityController::class, "showAdminActivity"])->name('admin.events');

Route::get('/activities', [ActivityController::class, "showUserActivity"])->name('user.activities');
Route::post('/activities/register', [ActivityController::class, "registerActivity"])->name('activities.register');
Route::post('/activities/cancel', [ActivityController::class, "cancelRegistration"])->name('activities.cancel');
Route::get('/detail/{id}', [ActivityController::class, "showActivityDetail"])->name('activity.detail');

Route::post("/activity" , [ActivityController::class, "createActivity"] )->name("activity.create");
Route::put('/activity/{id}', [ActivityController::class, 'updateActivity'])->name('activity.update');



Route::delete('/activity/{id}', [ActivityController::class, 'deleteActivity'])->name('activity.delete');
