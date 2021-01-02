<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Middleware;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TagController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia\Inertia::render('Chat/container');
})->name('chat');

Route::middleware('auth:sanctum')->get('/chat/rooms', [ConversationController::class, 'index']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [MessageController::class, 'index']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [MessageController::class, 'store']);
// Route::middleware('auth:sanctum')->get('/chat/user', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->get('/chat/tags', [TagController::class, 'index']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/tags', [TagController::class, 'show']);