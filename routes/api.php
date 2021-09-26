<?php

use App\Models\LatestUpdate;
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


Route::get('malaysia', 'App\Http\Controllers\LatestUpdateController@latest');
Route::post('state', 'App\Http\Controllers\LatestStateController@stateCase');
Route::get('case', 'App\Http\Controllers\LatestStateController@index');

Route::post('report/{id}','App\Http\Controllers\ReportController@store');
Route::get('report/me/{id}','App\Http\Controllers\ReportController@index');
Route::delete('report/me/{id}/delete/{report_id}','App\Http\Controllers\ReportController@destroy');
