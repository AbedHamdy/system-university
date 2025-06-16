<?php

use App\Http\Controllers\Auth\GeneralPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\DoctorManagementController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/" , [GeneralPasswordController::class, "index"])->name("home");

Route::post("/general_password" , [GeneralPasswordController::class, "check"])->name("general_password")->middleware('throttle:15,1');

Route::get("show_login_super_admin" , [LoginController::class, "loginSuperAdmin"])->name("show_login_superadmin");
Route::post("/login" , [LoginController::class, "checkCredential"])->name("login_super_admin");

Route::middleware(['auth:SuperAdmin'])->group(function () {
    Route::get("/dashboard_super_admin" , [SuperAdminDashboardController::class, "index"])->name("dashboard_SuperAdmin");

    Route::get("/all_category" , [CategoryController::class, "index"])->name("all_categories");
    Route::get("/my_category" , [CategoryController::class, "show"])->name("my_categories");
    Route::get("/create_category" , [CategoryController::class, "create"])->name("create_category");
    Route::post("/store_category" , [CategoryController::class, "store"])->name("store_category");
    Route::get('/edit_categories/{id}', [CategoryController::class, 'edit'])->name('edit_category');
    Route::put('/update_categories/{id}', [CategoryController::class, 'update'])->name('update_category');
    Route::delete('/delete_categories/{id}', [CategoryController::class, 'destroy'])->name('delete_category');

    Route::get("/create_doctor" , [DoctorManagementController::class, "create"])->name("create_doctor");
});

Route::post("/logout" , [LoginController::class, "destroy"])->name("logout_super_admin");
