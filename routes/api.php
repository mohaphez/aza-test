<?php

use App\Http\Controllers\MovieController;
use App\Http\Middleware\CacheRequest;
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

Route::get("movie/search", MovieController::class)->middleware(CacheRequest::class);
