<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\DogController::class, 'showTop'])->name('top');

//検索機能
Route::get('/list', [App\Http\Controllers\DogController::class, 'showList'])->name('list');

//記事ページ
Route::get('/article/{id}', [App\Http\Controllers\DogController::class, 'showArticle'])->name('article');

//要ログインの処理
Route::group(['middleware' => ['auth']], function () {
  Route::post('/favorite', [App\Http\Controllers\FavoriteController::class, 'favoriteJudge'])->name('favorite');
  Route::get('/mypage', [App\Http\Controllers\UserController::class, 'showMypage'])->name('mypage');
  Route::post('/empowerment', [App\Http\Controllers\UserController::class, 'empowerment'])->name('empowerment');
});

//管理者権限
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (){
  Route::get('/dogs/create', [App\Http\Controllers\Admin\DogController::class, 'showCreate'])->name('create'); //新規追加画面表示
  Route::post('/dogs', [App\Http\Controllers\Admin\DogController::class, 'store'])->name('store'); //登録処理
  Route::get('/article/{id}/edit', [App\Http\Controllers\Admin\DogController::class, 'showEdit'])->name('edit'); //編集画面表示
  Route::put('/article/{id}', [App\Http\Controllers\Admin\DogController::class, 'update'])->name('update'); //更新処理
  Route::delete('/article/{id}', [App\Http\Controllers\Admin\DogController::class, 'delete'])->name('delete'); //更新処理
});