<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function(){
    return response()->json([
        'success' => true
    ]);
});

Route::post('/login', [AuthController::class,'login'])->name('api.login');
Route::post('/register', [UserController::class,'register'])->name('register');


Route::middleware('jwt.auth')->group(function(){
    Route::apiResource('tasks', TaskController::class);
});

Route::get('/',function (){
    return response()->json(['message'=>'Welcome to API']);
});


