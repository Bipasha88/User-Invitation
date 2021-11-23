<?php

use App\Http\Controllers\InviteController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [TokenController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('invitation', [InviteController::class, 'invite']);
    Route::post('update-profile',[UserController::class,'updateProfile']);
});
Route::get('accept/{token}', [UserController::class, 'checkInvitation'])->name('accept');
Route::post('accept-invite/{token}', [UserController::class, 'acceptInvitation']);
Route::post('confirm-registration/{token}', [UserController::class, 'confirmRegistration']);
