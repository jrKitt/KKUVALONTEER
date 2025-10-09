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


//
// 🔹 Redirects
//
Route::get('/', fn() => redirect('/dashboard'));
Route::get('/home', fn() => redirect('/dashboard'))->name('home');

//
// 🔹 Static Pages
//
Route::get('/index', fn() => view('index'));
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/owner', [OwnerController::class, 'index']);
Route::get('/detail', fn() => view('valunteerdetails'));

//
// 🔹 Authentication
//
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('auth.login');
    Route::post('/login', 'login');

    Route::get('/register', 'showRegister')->name('auth.register');
    Route::post('/register', 'register');

    Route::get('/logout', 'logout')->name('auth.logout');
});

//
// Authen
//
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Volunteer Hours
    Route::resource('volunteer-hours', VolunteerHourController::class);

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
        Route::post('/image', [ProfileController::class, 'updateProfileImage'])->name('image.update');
        Route::delete('/image', [ProfileController::class, 'deleteProfileImage'])->name('image.delete');
    });

    // Goals
    Route::resource('goals', \App\Http\Controllers\GoalController::class);
    Route::post('/goals/update-progress', [\App\Http\Controllers\GoalController::class, 'updateProgress'])->name('goals.updateProgress');
    Route::post('/goals/{goal}/complete', [\App\Http\Controllers\GoalController::class, 'completeGoal'])->name('goals.complete');
    Route::post('/goals/complete', [\App\Http\Controllers\GoalController::class, 'completeGoalFromDashboard'])->name('goals.complete.dashboard');
    Route::get('/goals/{goal}/certificate', [\App\Http\Controllers\GoalController::class, 'generateCertificate'])->name('goals.certificate');

    // Debug Goal Progress
    Route::get('/debug/goals', function () {
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
                    ->map(fn($vh) => [
                        'activity' => $vh->activity_name,
                        'hours' => $vh->hours,
                        'date' => $vh->date->format('Y-m-d'),
                        'status' => $vh->status
                    ]),
                'checked_in_activities' => \DB::table('activity_participants')
                    ->join('activities', 'activity_participants.activity_id', '=', 'activities.id')
                    ->where('activity_participants.user_id', $user->id)
                    ->where('activity_participants.checked_in', true)
                    ->whereBetween('activities.start_time', [$goal->start_date, $goal->end_date])
                    ->select('activities.name_th', 'activities.start_time', 'activity_participants.actual_hours', 'activities.total_hour')
                    ->get(),
            ];
        }

        return response()->json($debug, JSON_PRETTY_PRINT);
    })->name('debug.goals');
});

//
// Admin Area
//
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ActivityController::class, 'getAdminDashboard'])->name('dashboard');
    Route::get('/', fn() => view('admin.index'));

    // Activities
    Route::get('/event', [ActivityController::class, 'showAdminActivity'])->name('events');
    Route::post('/activity', [ActivityController::class, 'createActivity'])->name('activity.create');
    Route::put('/activity/{id}', [ActivityController::class, 'updateActivity'])->name('activity.update');
    Route::delete('/activity/{id}', [ActivityController::class, 'deleteActivity'])->name('activity.delete');
    Route::post('/activity/{id}/finish', [ActivityController::class, 'finishActivity'])->name('activity.finish');

    // Check-in
    Route::get('/activities/{activity}/checkin', [CheckinController::class, 'show'])->name('activity.checkin');
    Route::post('/activities/{activity}/checkin', [CheckinController::class, 'checkin'])->name('activity.checkin.store');
    Route::post('/activities/{activity}/checkin/undo', [CheckinController::class, 'undoCheckin'])->name('activity.checkin.undo');
    Route::post('/activities/{activity}/checkin/bulk', [CheckinController::class, 'bulkCheckin'])->name('activity.checkin.bulk');

    // Sample Check-in Page
    Route::get('/checkin', function () {
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
    })->name('checkin');
});

//
// Public Activities
//
Route::get('/activities', [ActivityController::class, 'showUserActivity'])->name('user.activities');
Route::middleware('auth')->group(function () {
    Route::post('/activities/register', [ActivityController::class, 'registerActivity'])->name('activities.register');
    Route::post('/activities/cancel', [ActivityController::class, 'cancelRegistration'])->name('activities.cancel');
});
Route::get('/detail/{id}', [ActivityController::class, 'showActivityDetail'])->name('activity.detail');