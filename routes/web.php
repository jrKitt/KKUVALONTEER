<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VolunteerHourController;
use App\Http\Controllers\DashboardController;

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
Route::get('/about', function () {
    return view('about-us');
});
Route::get('/profile', function () {
    return view('profile');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('volunteer-hours', VolunteerHourController::class);
});

Route::get('/admin/dashboard' , function(){
    return view('admin/admin-dashboard');
});
Route::get('/admin/event' , function(){
    return view('admin/admin-event');
});
Route::get('/admin' , function(){
    return view('admin/index');
});


Route::get('/test', function () {
    return view('test');
});
