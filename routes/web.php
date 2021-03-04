<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MemberController; //※追加
use App\Http\Controllers\MultiAuthController; //※追加
use Laravel\Jetstream\Rules\Role;

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

Route::prefix('member')->middleware('auth:members')->group(function () { // ミドルウェア「membersでのログインが必須」をセットしました
    // この中は members としてログインしていないと表示できません
    Route::get('/', [MemberController::class, 'index']);
    Route::get('/list', [MemberController::class, 'list']);
    // Route::get('/{member}', [MemberController::class, 'show']);
    Route::post('/', [MemberController::class, 'store']);
    Route::put('/{member}', [MemberController::class, 'update']);
    Route::delete('/{member}', [MemberController::class, 'destroy']);
});

Route::prefix('multi_login')->group(function () {
    // この中はミドルウェアがついていないので誰でもアクセスできます
    Route::get('/', [MultiAuthController::class, 'showLoginForm'])->name('multi_login');
    Route::post('/', [MultiAuthController::class, 'login']);
    Route::get('/logout', [MultiAuthController::class, 'logout'])->name('multi_login.logout');
});

// ログイン後のページ
Route::prefix('members')->middleware('auth:members')->group(function () {
    Route::get('dashboard', function () {
        return 'ログイン完了';
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('test')->group(function () {

    if (app()->environment() === 'local') {

        Route::get('vue_component', function () {
            return view('test.vue_component');
        });
        Route::get('vue_parent_child', function () {
            return view('test.vue_parent_child');
        });
    }
});
