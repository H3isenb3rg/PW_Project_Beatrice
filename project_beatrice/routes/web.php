<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

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

Route::get("/", [FrontController::class, "getHome"])->name("home");

Route::group(["prefix" => "user"], function () {

    Route::get("login", [AuthController::class, "authentication"])->name("user.login");
    Route::post("login", [AuthController::class, "login"])->name("user.login");
    Route::post("resister", [AuthController::class, "registration"])->name("user.register");
    Route::get("logout", [AuthController::class, "logout"])->name("user.logout");

});

Route::resource("event", EventController::class);
