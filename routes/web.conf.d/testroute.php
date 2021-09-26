<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreetingController;

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
    return view('test');
});

//Route::get('greet', 'App\Http\Controllers\GreetingController@show');
Route::get('/greeting/{greeting}', [GreetingController::class, 'show']);

Auth::routes();

Route::get('/easter', function () {
    return false;
});