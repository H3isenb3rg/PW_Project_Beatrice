<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\VenueController;

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

Route::get("/", [FrontController::class, "getHome"])->name("home")->middleware(["lang"]);
Route::get('/lang/{lang}', [LangController::class, "changeLanguage"])->name("setLang");

// USER
Route::group(["prefix" => "user"], function () {

    Route::get("login", [AuthController::class, "authentication"])->name("user.login")->middleware(["lang"]);
    Route::post("login", [AuthController::class, "login"])->name("user.login");
    Route::post("resister", [AuthController::class, "registration"])->name("user.register");
    Route::get("logout", [AuthController::class, "logout"])->name("user.logout");
});

// EVENT
Route::group(["prefix" => "event"], function () {

    Route::get("create", [EventController::class, "goToCreate"])->name("event.create")->middleware(["isLogged"])->middleware(["isAdmin"])->middleware(["lang"]);
    Route::post("create", [EventController::class, "create"])->name("event.create")->middleware(["isLogged"])->middleware(["isAdmin"]);
    Route::get("index", [EventController::class, "goToCurrentEvents"])->name("event.index")->middleware(["lang"]);
    Route::get("info", [EventController::class, "goToCurrentEvents"])->name("event.info")->middleware(["lang"]);
});

// VENUE
Route::group(["prefix" => "venue"], function () {
    Route::post("create", [VenueController::class, "create"])->name("venue.create")->middleware(["isLogged"])->middleware(["isAdmin"])->middleware(["lang"]);
});
