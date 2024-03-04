<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\AdminController;



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
    return view('home');
});

Route::group(['middleware' => ['web']], function () {
Route::get('/login', [AuthController::class, 'loginView'])->name('auth.login');
Route::get('/register', [AuthController::class, 'registerView'])->name('auth.register');
Route::post('/step1-register', [AuthController::class, 'step1Register'])->name('auth.step1register');
Route::post('/step1-login', [AuthController::class, 'step1Login'])->name('auth.step1Login');
Route::get('/personal-details', [AuthController::class, 'personalDetails'])->name('user.personalDetails');
Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('user.editprofile');
Route::post('/user-profile-submit', [AuthController::class, 'userProfile'])->name('user.userProfile');
Route::post('/otp-verification', [AuthController::class, 'otpVerification'])->name('auth.verification');
Route::post('/login-otp-verification', [AuthController::class, 'loginOtpVerification'])->name('auth.loginVerification');
Route::post('/add-user-detail', [AuthController::class, 'addUserDetail'])->name('auth.addUserDetail');
Route::post('/step1-logout', [AuthController::class, 'step1Logout'])->name('auth.step1Logout');
// Route::post('/step2-login', [AuthController::class, 'step2Login'])->name('auth.userLogin');
Route::match(['get', 'post'], '/step2-login', [AuthController::class, 'step2Login'])->name('auth.userLogin');
Route::get('/forgot-password-view', [AuthController::class, 'forgotPasswordView'])->name('auth.forgotPassword');
Route::post('/otp-forgot-password', [AuthController::class, 'forgotPasswordOtp'])->name('auth.forgotPasswordOtp');
Route::post('/forgot-password-verify-otp', [AuthController::class, 'forgotPasswordVerifyOtp'])->name('auth.forgotPasswordVerification');
Route::get('/password-verify-otp', [AuthController::class, 'forgotPasswordOtpView'])->name('email.password-verify-otp');
Route::get('/new-password-view', [AuthController::class, 'newPasswordView'])->name('auth.newPasswordView');



Route::get('/verify-otp', [AuthController::class, 'verifyOtp'])->name('email.otpVerify');
Route::get('/login-verify-otp', [AuthController::class, 'loginVerifyOtp'])->name('email.loginMail');

});

Route::get('/admin', [AdminController::class, 'adminView'])->name('auth.admin');
Route::post('/update-status/{id}', [AdminController::class,'updateStatus']);
Route::get('/user-images/{userId}', [AdminController::class, 'getUserImages']);

