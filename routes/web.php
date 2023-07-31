<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AstrologerController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\AuthUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpertiesController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReportController;

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


// Auth
Route::get('/', [AuthController::class, 'loginPage'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login', [AuthController::class, 'login'])->name('login-admin');
Route::resource('register', RegisterController::class);


Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('profile', ProfileController::class);
    Route::post('image-profile/{id}', [ProfileController::class, 'profileImage'])->name('image-profile');
    Route::post('change-password/{id}', [AuthController::class, 'changePassword'])->name('change-password');
    Route::get('login/{id}', [AuthController::class, 'loginUsingId'])->name('loginUsingId');
    Route::resource('astrologer', AstrologerController::class);
    Route::get('is_active/{id}', [AstrologerController::class, 'is_active'])->name('is_active');
    Route::get('cost/{id}', [AstrologerController::class, 'costHr'])->name('costHr');
    Route::post('charge-store', [AstrologerController::class, 'storeCostHr'])->name('storeCostHr');
    Route::resource('experties', ExpertiesController::class);
    Route::resource('language', LanguageController::class);
    Route::resource('authuser', AuthUserController::class);
    Route::get('customers', [AuthUserController::class, 'customer'])->name('customers');
    Route::get('customer-delete/{id}', [AuthUserController::class, 'deleteCustomer'])->name('delete');

    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::get('user-permission/{id?}', [PermissionController::class, 'userPermission'])->name('userPermission');
    Route::post('assign-permission', [PermissionController::class, 'assignPermission'])->name('assignPermission');
    Route::get('roles-has-permission', [PermissionController::class, 'roleHasPermission'])->name('roleHasPermission');
    Route::get('view-role/{id}', [RoleController::class, 'viewRole'])->name('viewRole');
    Route::get('call-report', [ReportController::class, 'callReport'])->name('callReport');
    Route::get('chat-report', [ReportController::class, 'chatReport'])->name('chatReport');
    Route::get('revenue-report', [ReportController::class, 'revenueReport'])->name('revenueReport');
});

Route::group(['middleware' => 'common'], function () {
    Route::get('chat', [ChatController::class, 'chat'])->name('common-chat');
});
