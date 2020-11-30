
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    if(Auth::check()) { return response()->json(["name" => "Vinicius"]) ;};
    return $request->user();
});

Route::get('/' , function(Request $request){
    return response()->json(["message" => "Ta funcionando essa porra"]);
});
Route::post('/register' , [UserController::class, "store"]);
Route::put('/user' , [UserController::class, "update"]);
Route::get('/users' , [UserController::class, "index"]);
Route::post('/login' , [UserController::class, "login"]);
Route::post('/logout' , [UserController::class, "logout"]);

