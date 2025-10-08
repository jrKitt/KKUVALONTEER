<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CheckinController;
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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');

Route::get('/index', function () {
    return view('index');
});


// Route::get('/event', function () {
//     return view('event');
// });


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
    Route::resource('goals', \App\Http\Controllers\GoalController::class);
    Route::post('/goals/update-progress', [\App\Http\Controllers\GoalController::class, 'updateProgress'])->name('goals.updateProgress');
    Route::post('/goals/{goal}/complete', [\App\Http\Controllers\GoalController::class, 'completeGoal'])->name('goals.complete');
    Route::get('/goals/{goal}/certificate', [\App\Http\Controllers\GoalController::class, 'generateCertificate'])->name('goals.certificate');

    Route::get('/debug/goals', function() {
        $user = \Auth::user();
        $goals = $user->volunteerGoals()->get();

        $debug = [];
        foreach ($goals as $goal) {
            $goal->updateCurrentHours();
            $goal->refresh();

            $debug[] = [
                'goal_id' => $goal->id,
                'target_hours' => $goal->target_hours,
                'current_hours' => $goal->current_hours,
                'progress' => $goal->progress_percentage,
                'start_date' => $goal->start_date->format('Y-m-d'),
                'end_date' => $goal->end_date->format('Y-m-d'),
                'volunteer_hours' => $user->volunteerHours()
                    ->whereBetween('date', [$goal->start_date, $goal->end_date])
                    ->where('status', 'approved')
                    ->get()
                    ->map(function($vh) {
                        return [
                            'activity' => $vh->activity_name,
                            'hours' => $vh->hours,
                            'date' => $vh->date->format('Y-m-d'),
                            'status' => $vh->status
                        ];
                    }),
                'checked_in_activities' => \DB::table('activity_participants')
                    ->join('activities', 'activity_participants.activity_id', '=', 'activities.id')
                    ->where('activity_participants.user_id', $user->id)
                    ->where('activity_participants.checked_in', true)
                    ->whereDate('activities.start_time', '>=', $goal->start_date)
                    ->whereDate('activities.start_time', '<=', $goal->end_date)
                    ->select('activities.name_th', 'activities.start_time', 'activity_participants.actual_hours', 'activities.total_hour')
                    ->get()
            ];
        }

        return response()->json($debug, JSON_PRETTY_PRINT);
    })->name('debug.goals');
});

Route::get('/admin/dashboard' , [ActivityController::class, "getAdminDashboard"])->name('admin.dashboard');



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


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/event' , [ActivityController::class, "showAdminActivity"])->name('admin.events');
    Route::get('/admin/activities/{activity}/checkin', [CheckinController::class, 'show'])->name('admin.activity.checkin');
    Route::post('/admin/activities/{activity}/checkin', [CheckinController::class, 'checkin'])->name('admin.activity.checkin.store');
    Route::post('/admin/activities/{activity}/checkin/undo', [CheckinController::class, 'undoCheckin'])->name('admin.activity.checkin.undo');
    Route::post('/admin/activities/{activity}/checkin/bulk', [CheckinController::class, 'bulkCheckin'])->name('admin.activity.checkin.bulk');
    Route::post("/activity" , [ActivityController::class, "createActivity"] )->name("activity.create");
    Route::put('/activity/{id}', [ActivityController::class, 'updateActivity'])->name('activity.update');
    Route::delete('/activity/{id}', [ActivityController::class, 'deleteActivity'])->name('activity.delete');
    Route::post('/activity/{id}/finish', [ActivityController::class, 'finishActivity'])->name('activity.finish');
});

Route::get('/activities', [ActivityController::class, "showUserActivity"])->name('user.activities');
Route::post('/activities/register', [ActivityController::class, "registerActivity"])->name('activities.register')->middleware('auth');
Route::post('/activities/cancel', [ActivityController::class, "cancelRegistration"])->name('activities.cancel')->middleware('auth');
Route::get('/detail/{id}', [ActivityController::class, "showActivityDetail"])->name('activity.detail');