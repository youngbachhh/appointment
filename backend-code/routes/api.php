<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Redis;

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
Route::group([
    'middleware' => [
        App\Http\Middleware\ExpectJsonMiddleware::class,
    ],
], function () {

});

Route::group(['prefix' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('me', 'me');
    });
});

Route::apiResource('users', UserController::class);

Route::apiResource('profiles', ProfileController::class);
Route::get('profiles/user/{userId}', [ProfileController::class, 'getByUserId']);

Route::apiResource('clinics', ClinicController::class);

Route::apiResource('registrations', RegistrationController::class);
Route::get('registrations/clinic/{clinicId}', [RegistrationController::class, 'getByClinicId']);

Route::apiResource('departments', DepartmentController::class);
Route::get('departments/registration/{registrationId}', [DepartmentController::class, 'getByRegistrationId']);

Route::apiResource('services', ServiceController::class);
Route::get('services/department/{departmentId}', [ServiceController::class, 'getByDepartmentId']);

Route::apiResource('appointments', AppointmentController::class);