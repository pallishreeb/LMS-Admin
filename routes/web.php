<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatMessageController;


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
// Route::get('/', function () {
//     return view('welcome');
// });
