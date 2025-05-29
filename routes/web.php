<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthControllerSecond;
use App\Http\Controllers\ForgotPasswordController;

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


route::get('/register', [AuthController::class, 'register'])->name('register');
route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

//Dashboard routing
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
//logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//login
Route::get('/login', [AuthController::class, 'login'])->name('login');
//after submit data this route works
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

//ForgotPasswordController
Route::get('/password/forgot', [ForgotPasswordController::class, 'forgotPasswordForm'])->name('password.forgot');
//after submit data this route works
Route::post('/password/forgot', [ForgotPasswordController::class, 'forgotPasswordFormPost'])->name('password.forgot.post');
//Password reset link route
Route::get('/password/forgot/{token}', [ForgotPasswordController::class, 'showLinkForm'])->name('password.forgot.link');
Route::post('/password/email/submit', [ForgotPasswordController::class, 'resetPassword'])->name('password.forgot.link.submit');



// route::get('/register', [AuthControllerSecond::class, 'register']);
// route::post('/register', [AuthControllerSecond::class, 'registerPost'])->name('register.post');

