<?php

use Illuminate\Http\Request;

use Modules\Testimonial\Http\Controllers\Api\v1\TestimonialController;

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

// Route::middleware('auth:api')->get('/testimonial', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => config('app.api_version'),'as' => 'api.','middleware'=>'localization'], function () {
    //for no auth routes

    Route::get('/testimonial-detail/{id}',[TestimonialController::class,'testimonialView'])->name('testimonial-view');
    Route::get('/testimonial-list',[TestimonialController::class,'testimonialList'])->name('testimonial-list');

});

Route::group(['prefix' => config('app.api_version'), 'as' => 'api.','middleware'=>['auth:sanctum','localization']], function () {
    //for auth routes


});