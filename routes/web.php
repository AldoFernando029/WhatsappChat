<?php
use App\Http\Controllers\AuthController;

<<<<<<< HEAD
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
=======
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
>>>>>>> b02ef98213ab7af5f9ae371b80af25c67442bc4e
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\ChatController;

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/chat/user/{user}', [ChatController::class, 'getMessages']);
    Route::post('/chat/send', [ChatController::class, 'send']);
});

?>


