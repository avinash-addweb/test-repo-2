<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Laravel\Fortify\Http\Controllers\RegisteredUserController; 
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController; 
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

//use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
//use App\Http\Controllers\EmailVerificationNotificationController;

//CommonController used for no auth common api
use App\Http\Controllers\Api\v1\CommonController;
use App\Http\Controllers\Api\v1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$verificationLimiter = config('fortify.limiters.verification', '6,1');

Route::group(['prefix' => config('app.api_version'),'as' => 'api.','middleware'=>['localization']], function () {
    
    Route::get('/role-list', [CommonController::class, 'roleList'])->name('role-list');
    Route::get('/language-list', [CommonController::class, 'languageList'])->name('language-list');
    Route::get('/module-list', [CommonController::class, 'moduleList'])->name('module-list');
    Route::get('/setting-list', [CommonController::class, 'settingList'])->name('setting-list');

    $limiter = false;//config('fortify.limiters.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(array_filter([
        'guest:'.config('fortify.guard'),
        $limiter ? 'throttle: '.$limiter: null,
    ]))->name('user-login');

    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['guest:'. config('fortify.guard')])->name('user-register');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    //Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');

});

Route::group(['prefix' => config('app.api_version'), 'as' => 'api.','middleware'=>['auth:sanctum','localization']], function () {

    Route::get('/user', [UserController::class, 'userDetail'])->name('user');
    Route::post('/logout', [UserController::class, 'userLogout'])->name('logout');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password');
    Route::post('/secret-details', [UserController::class, 'commonSecretDetail'])->name('common-secret-details');

});
