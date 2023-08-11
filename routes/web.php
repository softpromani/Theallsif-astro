<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AstrologerController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\AuthUserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpertiesController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
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
    // Route::post('upload-csv', [AstrologerController::class, 'uploadCsv'])->name('uploadCsv');
    Route::get('expoart', [AstrologerController::class, 'exportAstrologer'])->name('exportAstrologer');

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
    Route::get('web-pages/{type?}', [AuthUserController::class, 'webPage'])->name('webPage');
    Route::post('web-update', [AuthUserController::class, 'webpageUpdate'])->name('webpageUpdate');
    Route::post('faq-add', [DashboardController::class, 'faqAdd'])->name('faqAdd');
    Route::get('faq/{id?}', [DashboardController::class, 'faq'])->name('faq');
    Route::get('faq-edit/{id}', [DashboardController::class, 'faqEdit'])->name('faqEdit');

    Route::get('category', [BlogController::class, 'category'])->name('category');
    Route::post('category-store', [BlogController::class, 'categoryStore'])->name('categoryStore');
    Route::get('category-edit/{id}', [BlogController::class, 'categoryEdit'])->name('categoryEdit');
    Route::post('category-update/{id}', [BlogController::class, 'categoryUpdate'])->name('categoryUpdate');
    Route::post('category-delete/{id}', [BlogController::class, 'categoryDelete'])->name('categoryDelete');

    Route::get('blog', [BlogController::class, 'blog'])->name('blog');
    Route::post('blog-store', [BlogController::class, 'blogStore'])->name('blogStore');
    Route::get('blog-status/{id}', [BlogController::class, 'is_activeBlog'])->name('is_activeBlog');
    Route::get('blog-edit/{id}', [BlogController::class, 'blogEdit'])->name('blogEdit');
    Route::post('blog-update/{id}', [BlogController::class, 'blogUpdate'])->name('blogUpdate');
    Route::post('blog-delete/{id}', [BlogController::class, 'blogDelete'])->name('blogDelete');
    Route::get('image-show/{id}', [BlogController::class, 'imageShow'])->name('imageShow');
    Route::get('image-edit/{id}', [BlogController::class, 'imageEdit'])->name('imageEdit');
    Route::post('image-update', [BlogController::class, 'imageUpdate'])->name('imageUpdate');
    Route::post('image-delete/{id}', [BlogController::class, 'imageDelete'])->name('imageDelete');

    Route::get('event', [BlogController::class, 'event'])->name('event');
    Route::post('event-store', [BlogController::class, 'eventStore'])->name('eventStore');
    Route::get('event-status/{id}', [BlogController::class, 'is_activeEvent'])->name('is_activeEvent');
    Route::get('event-edit/{id}', [BlogController::class, 'eventEdit'])->name('eventEdit');
    Route::post('event-update/{id}', [BlogController::class, 'eventUpdate'])->name('eventUpdate');
    Route::post('event-delete/{id}', [BlogController::class, 'eventDelete'])->name('eventDelete');
    Route::get('image-event-show/{id}', [BlogController::class, 'imageeventShow'])->name('imageeventShow');
    Route::get('image-event-edit/{id}', [BlogController::class, 'imageeventEdit'])->name('imageeventEdit');
    Route::post('image-event-update', [BlogController::class, 'imageeventUpdate'])->name('imageeventUpdate');
    Route::post('image-event-delete/{id}', [BlogController::class, 'imageeventDelete'])->name('imageeventDelete');

    Route::get('offers', [AuthController::class, 'offers'])->name('offers');
    Route::post('offer-store', [AuthController::class, 'offerStore'])->name('offerStore');
    Route::get('offer-status/{id}', [AuthController::class, 'is_activeOffer'])->name('is_activeOffer');
    Route::get('offer-edit/{id}', [AuthController::class, 'offerEdit'])->name('offerEdit');
    Route::post('offer-update/{id}', [AuthController::class, 'offerUpdate'])->name('offerUpdate');
    Route::post('offer-delete/{id}', [AuthController::class, 'offerDelete'])->name('offerDelete');

    Route::get('teams', [TeamController::class, 'teams'])->name('teams');
    Route::post('team-store', [TeamController::class, 'teamStore'])->name('teamStore');
    Route::get('team-status/{id}', [TeamController::class, 'is_activeTeam'])->name('is_activeTeam');
    Route::get('team-edit/{id}', [TeamController::class, 'teamEdit'])->name('teamEdit');
    Route::post('team-update/{id}', [TeamController::class, 'teamUpdate'])->name('teamUpdate');
    Route::post('team-delete/{id}', [TeamController::class, 'teamDelete'])->name('teamDelete');

    Route::get('web-sliders', [BlogController::class, 'webSlider'])->name('webSlider');
    Route::post('web-sliders-store', [BlogController::class, 'webSliderStore'])->name('webSliderStore');
    Route::get('web-sliders-status/{id}', [BlogController::class, 'is_activeWebslider'])->name('is_activeWebslider');
    Route::get('web-sliders-edit/{id}', [BlogController::class, 'webSliderEdit'])->name('webSliderEdit');
    Route::post('web-sliders-update/{id}', [BlogController::class, 'webSliderUpdate'])->name('webSliderUpdate');
    Route::post('web-sliders-delete/{id}', [BlogController::class, 'webSliderDelete'])->name('webSliderDelete');
    Route::get('image-web-sliders-show/{id}', [BlogController::class, 'imageWebsliderShow'])->name('imageWebsliderShow');
    Route::get('image-web-sliders-edit/{id}', [BlogController::class, 'imageWebsliderEdit'])->name('imageWebsliderEdit');
    Route::post('image-web-sliders-update', [BlogController::class, 'imageWebsliderUpdate'])->name('imageWebsliderUpdate');
    Route::post('image-web-sliders-delete/{id}', [BlogController::class, 'imageWebsliderDelete'])->name('imageWebsliderDelete');
});

Route::group(['middleware' => 'common'], function () {
    Route::get('chat', [ChatController::class, 'chat'])->name('common-chat');
});
