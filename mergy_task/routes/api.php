<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\ExperienceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//admin register
Route::post('auth/register', [AuthController::class, 'register']);

//Admin login
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum'], 'prefix' => 'users'], function(){
    Route::apiResource('job',JobController::class);
    Route::apiResource('experience',ExperienceController::class);
    Route::get('jobwithexperience', [ExperienceController::class, 'getJobWithExperience']);
   
});
