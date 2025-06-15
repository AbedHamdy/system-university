<?php

use App\Http\Controllers\Auth\GeneralPasswordController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get("/" , [GeneralPasswordController::class, "index"])->name("home");
// Route::post("/general_password" , [GeneralPasswordController::class, "check"])->name("general_password");

// Route::get("/dashboard_super" , [SuperAdminDashboardController::class, "index"])->name("dashboard_super_admin");

