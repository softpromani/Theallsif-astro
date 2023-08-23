<?php

use App\Http\Controllers\Frontend\Api\AstrologerController;
use App\Http\Controllers\Frontend\Api\AuthController;
use App\Http\Controllers\Frontend\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('send-otp', [AuthController::class, 'sendOTP']);
Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
Route::post('sign-up', [AuthController::class, 'signUp']);
Route::group(['prefix' => 'astrology', 'middlware' => 'auth:api'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/astrologers-show', [AstrologerController::class, 'getAstrologerCount']);
    Route::post('/astrologers', [AstrologerController::class, 'getAstrologer']);
    Route::post('/astrologer', [AstrologerController::class, 'astrologer']);
    Route::get('/experties', [AstrologerController::class, 'getExperties']);
    Route::get('/languages', [AstrologerController::class, 'getlanguages']);
    Route::post('/web-page', [AstrologerController::class, 'webPage']);
    Route::get('/faq', [AstrologerController::class, 'faq']);
    Route::post('/give-rating-review', [AstrologerController::class, 'ratingReview']);
    Route::post('/edit-profile', [AuthController::class, 'updateProfile']);
    Route::post('/comment-store', [BlogController::class, 'commentStore']);
});
