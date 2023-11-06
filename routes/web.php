<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionsController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/sessions', [SessionsController::class, 'index']);
Route::get('/sessions/list', [SessionsController::class, 'list']);
Route::get('/sessions/summary', [SessionsController::class, 'summary']);
Route::post('/sessions/create', [SessionsController::class, 'create']);
