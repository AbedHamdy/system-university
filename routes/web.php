<?php

use App\Http\Controllers\Auth\GeneralPasswordController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/" , [GeneralPasswordController::class, "index"])->name("home");
Route::post("/general_password" , [GeneralPasswordController::class, "check"])->name("general_password");

Route::get("/dashboard_super" , [SuperAdminDashboardController::class, "index"])->name("dashboard_super_admin");
