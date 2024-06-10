<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Articles;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Permissions;


use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SuperUserController;
use App\Http\Controllers\Admin\MediaUploadController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ActivityLogController;
//use App\Http\Middleware\PaymentGatewayRequestValidate;
use App\Http\Controllers\Common\StripeWebhookController;

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
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect('/');
});

Route::group(['middleware'=>['auth:sanctum', config('jetstream.auth_session'), 'verified','backend','localization'],'prefix'=>config('fortify.prefix')],function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('user', AdminController::class);
    Route::resource('role', RoleController::class);
    Route::get('/permission/sync', [PermissionController::class,'syncPermisssions'])->name('permission.sync');
    Route::resource('permission', PermissionController::class);
    Route::get('/module-list', [SuperUserController::class,'moduleList'])->name('module-list');
    Route::get('/custom-command/{cmd?}', [SuperUserController::class,'customCommand'])->name('customcommand');
    Route::get('/media-upload', [MediaUploadController::class,'index'])->name('mediaUpload.index');
    Route::get('/media-upload/{mediaUpload}', [MediaUploadController::class,'show'])->name('mediaUpload.show');
    Route::get('/activity-log', [ActivityLogController::class,'index'])->name('activityLog.index');
    Route::get('/activity-log/{activityLog}', [ActivityLogController::class,'show'])->name('activityLog.show');
    Route::resource('general-settings/{tab?}', GeneralSettingController::class,['names'=>'generalSettings'])->except(['edit','update','show','destroy']);
    Route::put('general-settings/update/{tab?}', [GeneralSettingController::class,'update'])->name('generalSettings.update');
    Route::get('/general-settings/{generalSetting}/{tab?}', GeneralSettingController::class .'@destroyImage')->name('generalSettings.destroyImage');
    Route::get('/general-settings-clear/clearConfig/{tab?}', GeneralSettingController::class .'@clearConfig')->name('generalSettings.clearConfig');
    Route::get('/general-settings-clear/clearCache/{tab?}', GeneralSettingController::class .'@clearCache')->name('generalSettings.clearCache');
    Route::get('/change-language/{langCode?}', [DashboardController::class,'changeLanguage'])->name('changeLanguage');
    Route::get('/file-manager', [App\Http\Controllers\Admin\FileManagerController::class, 'index'])->name('fm.index');

    /*
     //Route::get('/payment-setting/{id}', GeneralSettingController::class.'@paymentSetting')->name('payment.setting');
    */
    
});

/*
Route::get('test-email', function () {
    $details = [
        'title' => 'Mail from Library collection',
        'body' => 'This is for testing email using smtp'
    ];
    \Mail::to('manoj@addwebsolution.in')->send(new \App\Mail\MyTestMail($details));
    dd("Email is Sent.");
})->name('test email');
*/

Route::post('stripe/webhook', [StripeWebhookController::class,'handleWebhook'])->name('stripe-webhook');