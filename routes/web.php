<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('login'));
});

Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'profile2'])->name('profile2');
Route::get('/request', [App\Http\Controllers\ApplyLeaveRequestController::class, 'index'])->name('req');
Route::post('/request2', [App\Http\Controllers\ApplyLeaveRequestController::class, 'store'])->name('requestStore');
Route::get('/request3/{id}', [App\Http\Controllers\ApplyLeaveRequestController::class, 'update']);
Route::get('/request4/{id}', [App\Http\Controllers\ApplyLeaveRequestController::class, 'pupdate']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
