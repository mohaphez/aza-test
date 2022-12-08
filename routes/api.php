<?php

use App\Http\Controllers\ConvertController;
use App\Http\Controllers\LanguageController;
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

Route::middleware([CacheRequest::class])->group(
    function () {
        Route::get("movie/search", MovieController::class);
        Route::get("languages/list", [LanguageController::class, 'list']);
    }
);

Route::post("convert/spellout", [ConvertController::class, 'spellout']);
