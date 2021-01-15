<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MemberController; //※追加

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

//※ルーティングの書き方変わった
//※Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'web'], function () {。。。これとの違いは？
Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/list', [PostController::class, 'list']);
    Route::get('/{post}', [PostController::class, 'show']);
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{post}', [PostController::class, 'update']);
    Route::delete('/{post}', [PostController::class, 'destroy']);
});

//※追加
Route::prefix('member')->group(function () {
    Route::get('/', [MemberController::class, 'index']);
    Route::get('/list', [MemberController::class, 'list']);
    // Route::get('/{member}', [MemberController::class, 'show']);
    Route::post('/', [MemberController::class, 'store']);
    Route::put('/{member}', [MemberController::class, 'update']);
    Route::delete('/{member}', [MemberController::class, 'destroy']);
});
