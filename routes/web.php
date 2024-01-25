<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomForgotPasswordController;

//chat
Route::get('/user-messages', [ChatMessageController::class, 'index'])->name('user-messages');
Route::get('/user-chats/{user}', [ChatMessageController::class, 'showUserChats'])->name('user-chats');
Route::post('/user-chats/{user}/reply', [ChatMessageController::class, 'reply'])->name('user-chats.reply');
Route::delete('/delete-chat/{id}', [ChatMessageController::class, 'delete'])->name('delete-chat');

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
Route::redirect('/', '/admin');
Route::redirect('/admin/register', '/register');
Route::redirect('/admin/login', '/login');
// Show Register/Create Form
Route::get('/register', [AuthController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/register', [AuthController::class, 'store'])->name('store');
// Show Login Form
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

// password reset

// Show forgot password form
Route::get('/forgot-password', [CustomForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');

// Handle forgot password form submission
Route::post('/forgot-password', [CustomForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Show reset password form
Route::get('/reset-password/{token}', [CustomForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// Handle reset password form submission
Route::post('/reset-password', [CustomForgotPasswordController::class, 'reset'])->name('password.update');
// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/verify-otp', [AuthController::class, 'showOtpVerificationForm'])->name('verify.otp.form');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
