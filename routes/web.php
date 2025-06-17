<?php

use App\Http\Controllers\Auth\GeneralPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\CourseController;
use App\Http\Controllers\SuperAdmin\DoctorManagementController;
use App\Http\Controllers\SuperAdmin\LevelController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Models\Level;
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

    Route::get("/all_categories" , [CategoryController::class, "index"])->name("all_categories");
    Route::get("/create/category" , [CategoryController::class, "create"])->name("create_category");
    Route::post("/store/category" , [CategoryController::class, "store"])->name("store_category");
    Route::get("/my_categories" , [CategoryController::class, "show"])->name("my_categories");
    Route::get('/edit/categories/{id}', [CategoryController::class, 'edit'])->name('edit_category');
    Route::put('/update/categories/{id}', [CategoryController::class, 'update'])->name('update_category');
    Route::delete('/delete/categories/{id}', [CategoryController::class, 'destroy'])->name('delete_category');

    Route::get("/all_levels" , [LevelController::class, "index"])->name("all_levels");
    Route::get("/create/level" , [LevelController::class, "create"])->name("create_level");
    Route::post("/store/level" , [LevelController::class, "store"])->name("store_level");
    Route::get("/my_levels" , [LevelController::class, "show"])->name("my_levels");
    // Route::get('/edit_levels/{id}', [LevelController::class, 'edit'])->name('edit_level');
    // Route::put('/update_levels/{id}', [LevelController::class, 'update'])->name('update_level');
    Route::delete("/delete/levels/{id}" , [LevelController::class, 'destroy'])->name('delete_level');

    Route::get("/all_semesters" , [SemesterController::class, "index"])->name("all_semesters");
    Route::get('/show_semesters', [SemesterController::class, 'show'])->name('show_semesters');
    Route::get("/create/semester" , [SemesterController::class, "create"])->name("create_semester");
    Route::post("/store/semester" , [SemesterController::class, "store"])->name("store_semester");

    Route::get("/create/course" , [CourseController::class, "create"])->name("create_course");
    Route::get('/get-levels-by-category/{categoryId}', [CourseController::class, 'getLevelsByCategory'])->name('get.levels.by.category');
    Route::get('/get-semesters-by-level/{levelId}', [CourseController::class, 'getSemestersByLevel'])->name('get.semesters.by.level');
    // Route::get('/get-semesters-by-level/{levelId}', [CourseController::class, 'getSemestersByLevel']);
    Route::post("/store/course" , [CourseController::class, "store"])->name("store_course");

    Route::get("/all_doctors" , [DoctorManagementController::class, "index"])->name("all_doctors");
    Route::get("/create/doctor" , [DoctorManagementController::class, "create"])->name("create_doctor");
    Route::post("/store/doctor" , [DoctorManagementController::class, "store"])->name("store_doctor");
    Route::get("/edit/doctor/{id}" , [DoctorManagementController::class, "edit"])->name("edit_doctor");
    Route::put("/update/doctor/{id}" , [DoctorManagementController::class, "update"])->name("update_doctor");
    Route::delete("/delete/doctor/{id}" , [DoctorManagementController::class, "destroy"])->name("delete_doctor");
});

Route::post("/logout" , [LoginController::class, "destroy"])->name("logout_super_admin");
