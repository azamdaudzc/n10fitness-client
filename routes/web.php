<?php

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserControllers\UserClientController;
use App\Http\Controllers\UserControllers\UserCheckinController;
use App\Http\Controllers\N10Controllers\AssignedCoachController;
use App\Http\Controllers\N10Controllers\AssignedProgramsController;
use App\Http\Controllers\N10Controllers\ProgramInfoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/migratedatabase', function () {
    Artisan::call('migrate:fresh --seed');
});

Route::middleware(['auth', 'check_user_type', 'verified'])->group(function () {
    Route::get('/send-email', [JobController::class, 'enqueue']);
    Route::get('/', function () {
        $data['page_heading'] = "Dashboard";
        $data['sub_page_heading'] = "main dashboard";
        return view('dashboard')->with($data);
    });
    Route::get('/dashboard', function () {
        $data['page_heading'] = "Dashboard";
        $data['sub_page_heading'] = "main dashboard";
        return view('dashboard')->with($data);
    })->name('dashboard');

    Route::controller(AssignedCoachController::class)->group(function () {
        Route::get('assigned/coach/index', 'index')->name('assigned.coach.index');
    });

    Route::controller(AssignedProgramsController::class)->group(function () {
        Route::get('assigned/programs/index', 'index')->name('assigned.programs.index');
        Route::get('assigned/programs/view/{id?}', 'view')->name('assigned.programs.view');
        Route::get('assigned/programs/view-week/{id?}/{last_id?}', 'view_week')->name('assigned.programs.view-week');
        Route::get('assigned/programs/view-day/{id?}/{last_id?}', 'view_day')->name('assigned.programs.view-day');
        Route::get('assigned/programs/view-day-prepare', 'view_day_prepare')->name('assigned.programs.view-day-prepare');
        Route::post('assigned/programs/store-day', 'store_day')->name('assigned.programs.store-day');
    });

    Route::controller(UserClientController::class)->group(function () {
        Route::get('user/client/profile', 'profile')->name('user.client.profile');
        Route::post('user/client/details', 'details')->name('user.client.details');
        Route::post('user/client/info', 'info')->name('user.client.info');
        Route::post('user/client/store', 'store')->name('user.client.store');
    });
    Route::controller(UserCheckinController::class)->group(function () {
        Route::post('checkin/questions/list', 'list')->name('checkin.questions.list');
        Route::post('checkin/questions/store', 'store')->name('checkin.questions.store');

    });

    Route::controller(ProgramInfoController::class)->group(function () {
        Route::post('program/info/warmup', 'warmupInfo')->name('program.info.warmup');
        Route::post('program/info/exercise', 'exerciseInfo')->name('program.info.exercise');

    });

    Route::get('mark/notification/done',function (){
        Notification::where('user_id',Auth::user()->id)->update(['read' => 1]);
    })->name('mark.notification.done');
});


require __DIR__ . '/auth.php';
