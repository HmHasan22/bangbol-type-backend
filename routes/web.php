<?php

use App\Http\Controllers\ResultController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\QualificationController;
use App\Models\Qualification;

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

// Route::get("/",[PostController::class,'index']);
Route::get("/insert-data", [PostController::class, 'create']);

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('guest');

Route::group(['prefix' => 'league', 'middleware' => 'auth'], function () {
    Route::get("/", [LeagueController::class, 'index'])->name('league.index');
    Route::get("/create", [LeagueController::class, 'create'])->name('add-league');
    Route::post("/create", [LeagueController::class, 'store'])->name('create-league');
    Route::get("/edit/{id}", [LeagueController::class, 'edit'])->name('edit-league');
    Route::post("/update", [LeagueController::class, 'update'])->name('update-league');
    Route::get("/delete/{id}", [LeagueController::class, 'destroy'])->name('delete-league');
    Route::get("category", [PostController::class, 'category'])->name('category');
});

Route::group(['prefix' => 'result', 'middleware' => 'auth'], function () {
    Route::get("/", [ResultController::class, 'index'])->name('result.index');
    Route::get("/create", [ResultController::class, 'create'])->name('result.create');
    Route::post("/create", [ResultController::class, 'store'])->name('result.store');
    Route::get("/edit/{id}", [ResultController::class, 'edit'])->name('result.edit');
    Route::post("/update", [ResultController::class, 'update'])->name('result.update');
    Route::get("/delete/{id}", [ResultController::class, 'destroy'])->name('result.delete');
});

Route::group(["prefix" => "score", "middleware" => "auth"], function () {
    Route::get("/", [ScoreController::class, 'index'])->name("score.index");
    Route::get("/create/{id}", [ScoreController::class, 'create'])->name("score.create");
    Route::post("/store", [ScoreController::class, 'store'])->name("score.store");
    Route::get("/edit/{id}", [ScoreController::class, 'edit'])->name("score.edit");
    Route::post("/update", [ScoreController::class, 'update'])->name("score.update");
    Route::get("/delete/{id}", [ScoreController::class, 'destroy'])->name("score.destroy");
});

Route::post("qualification", [QualificationController::class, 'store'])->name('qualification')->
middleware('auth');
