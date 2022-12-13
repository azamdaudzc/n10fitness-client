<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetApiDataController;
use App\Http\Controllers\UserControllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/get/athletic-types', [GetApiDataController::class, 'getAthleticTypes']);


Route::post('/auth/register', [RegisterController::class, 'register']);

Route::post('/auth/login', [RegisterController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Request $request) {
        return auth()->user();
    });
    Route::get('/get/checkin-questions', [GetApiDataController::class, 'getCheckinQuestions']);
    Route::post('/store/checkin-question-ans', [GetApiDataController::class, 'saveCheckinAnswer']);

    // Route::get('get/user/programs',[GetApiDataController::class,'getUserPrograms']);
    Route::get('get/user/program/weeks',[GetApiDataController::class,'getUserProgramWeeks']);
    Route::post('get/user/program/days',[GetApiDataController::class,'getUserProgramDays']);
    Route::post('get/user/program/day/info', [GetApiDataController::class, 'getUserProgramDayInfo']);
    Route::post('user/program/day/store', [GetApiDataController::class, 'store_day']);
    Route::post('get/user/program/day/exercisesets', [GetApiDataController::class, 'get_day_exercise_sets']);

    Route::get('get/user/notifications', [GetApiDataController::class, 'user_notifications']);
    Route::get('mark/read/user/notifications', [GetApiDataController::class, 'mark_read_notifications']);
    Route::post('get/warmup/info', [GetApiDataController::class, 'get_warmup_info']);
    Route::post('get/exercise/info', [GetApiDataController::class, 'get_exercise_info']);
    Route::get('get/all/exercise/libraries', [GetApiDataController::class, 'get_all_exercise_libraries']);

    Route::post('update/client/profile', [GetApiDataController::class, 'update_profile']);

    Route::post('/auth/logout', [RegisterController::class, 'logout']);



});
