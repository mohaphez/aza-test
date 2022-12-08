<?php

use App\Models\StarLog;
use App\Service\Currency\ICurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/convert', function () {
    return view('convert.spellout');
});

Route::get("price", function () {
    $currency = app(ICurrency::class);
    $prices = $currency->getCurrencyPrice();
    $user = auth()->loginUsingId(1);
    $data = [
        "name" => $user->name,
        "email" => $user->email,
        "subject" => "Currency price",
        "prices" => $prices
    ];
    return view('emails.currencyPrice', compact('data'));
});

Route::get('add-star', function (Request $request) {
    StarLog::create(['user_id' => 1, 'post_id' => 1, 'star' => $request->input('star')]);
    return "New Log was recorded";
});
