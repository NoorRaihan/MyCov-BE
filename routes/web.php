<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

$routePath=__DIR__;

$files = scandir("$routePath/web.conf.d");
foreach($files as $r){
	if($r=="." || $r==".."){
		continue;
	}
	$t="$routePath/web.conf.d/$r";
	if(substr($t,-4,4)==".php"){
		//print "<br>$t";
		require_once($t);
	}
}

// Route::get('/dummy', function () {
//     return view('welcome');
// });



// Route::get('/add_role', 'App\Http\Controllers\RoleController@addRole');

// Route::group(['middleware' => ['can: tengok']],function () {
// 	Route::get('/dummy', function () {
// 		   return view('welcome');
// 		});
// });

Route::prefix('admin')->group(function () {
	Route::resources([
		'roles' => RoleController::class,
		'user'	=> UserController::class,
	]);
});

// Route::group(['middleware' => ['role:ketua']], function() {
// 	Route::prefix('admin')->group(function () {
// 		Route::resources([
// 			'roles' => RoleController::class,
// 			'user'	=> UserController::class,
// 		]);
// 	});
// });


