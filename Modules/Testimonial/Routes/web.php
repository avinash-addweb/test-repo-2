<?php

use Modules\Testimonial\Http\Controllers\Admin\TestimonialController;

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

// Route::prefix('testimonial')->group(function() {
//     Route::get('/', 'TestimonialController@index');
// });

Route::group(['prefix'=>config('fortify.prefix').('/testimonials'),'middleware'=>'localization'],function () {
    //for no auth routes

});

Route::group(['middleware'=>['auth:sanctum', config('jetstream.auth_session'), 'verified','localization'],'prefix'=>config('fortify.prefix').('/testimonial')],function () {
    //for auth routes
    Route::get('/', TestimonialController::class .'@index')->name('testimonial::testimonial.index');
    Route::get('/create', TestimonialController::class . '@create')->name('testimonial::testimonial.create');
    Route::post('/testimonial', TestimonialController::class .'@store')->name('testimonial::testimonial.store');
    Route::get('/{testimonial}', TestimonialController::class .'@show')->name('testimonial::testimonial.show');
    Route::get('/{testimonial}/edit/{langCode?}', TestimonialController::class .'@edit')->name('testimonial::testimonial.edit');
    Route::put('/{testimonial}', TestimonialController::class .'@update')->name('testimonial::testimonial.update');
    Route::delete('/{testimonial}', TestimonialController::class .'@destroy')->name('testimonial::testimonial.destroy');
});