<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/p/{slug}', [FrontArticleController::class, 'show']);
Route::get('/articles', [FrontArticleController::class, 'index']);
Route::post('/article/search', [FrontArticleController::class, 'index'])->name('search');

Route::get('category/{slug}', [FrontCategoryController::class, 'index']);

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/article', ArticleController::class);

    Route::resource('/categories', CategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ])->middleware('UserAccess:1');

    Route::resource('/users', UserController::class);

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function() {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::get('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});