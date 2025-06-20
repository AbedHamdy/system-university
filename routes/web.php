<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AssignCoursesController;
use App\Http\Controllers\Auth\GeneralPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\CourseController;
use App\Http\Controllers\SuperAdmin\DoctorManagementController;
use App\Http\Controllers\SuperAdmin\LevelController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SemesterController;
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
    Route::get("/dashboard/super_admin" , [SuperAdminDashboardController::class, "index"])->name("dashboard_SuperAdmin");

    Route::get("/all_categories" , [CategoryController::class, "index"])->name("all_categories");
    Route::get("/create/category" , [CategoryController::class, "create"])->name("create_category");
    Route::post("/store/category" , [CategoryController::class, "store"])->name("store_category");
    Route::get("/my_categories" , [CategoryController::class, "show"])->name("my_categories");
    Route::get('/edit/categories/{id}', [CategoryController::class, 'edit'])->name('edit_category');
    Route::put('/update/categories/{id}', [CategoryController::class, 'update'])->name('update_category');
    Route::delete('/delete/categories/{id}', [CategoryController::class, 'destroy'])->name('delete_category');

    // Route::post("/create/level" , [LevelController::class, "create"])->name("create_level");
    Route::get("/create/level" , [LevelController::class, "create"])->name("create_level");
    Route::post("/store/level" , [LevelController::class, "store"])->name("store_level");
    Route::get('/edit/level', [LevelController::class, 'edit'])->name('edit_level');
    Route::put('/update/level', [LevelController::class, 'update'])->name('update_level');

    Route::get("/create/semester" , [SemesterController::class, "create"])->name("create_semester");
    Route::post("/store/semester" , [SemesterController::class, "store"])->name("store_semester");

    Route::get("/all_courses" , [CourseController::class, "index"])->name("all_courses");
    Route::get("/create/course" , [CourseController::class, "create"])->name("create_course");
    // Route::get('/ajax/doctors/{categoryId}', [App\Http\Controllers\AjaxController::class, 'getDoctorsByCategory']);
    // Route::get('/ajax/levels/{categoryId}', [App\Http\Controllers\AjaxController::class, 'getLevelsByCategory']);
    // Route::get('/ajax/semesters/{levelId}', [App\Http\Controllers\AjaxController::class, 'getSemestersByLevel']);
    Route::post("/store/course" , [CourseController::class, "store"])->name("store_course");
    Route::delete("/delete/course/{id}" , [CourseController::class, "destroy"])->name("delete_course");

    Route::get("/all_doctors" , [DoctorManagementController::class, "index"])->name("all_doctors");
    Route::get("/create/doctor" , [DoctorManagementController::class, "create"])->name("create_doctor");
    Route::post("/store/doctor" , [DoctorManagementController::class, "store"])->name("store_doctor");
    Route::get("/edit/doctor/{id}" , [DoctorManagementController::class, "edit"])->name("edit_doctor");
    Route::put("/update/doctor/{id}" , [DoctorManagementController::class, "update"])->name("update_doctor");
    Route::delete("/delete/doctor/{id}" , [DoctorManagementController::class, "destroy"])->name("delete_doctor");

    Route::get("/all_admins" , [AdminManagementController::class, "index"])->name("all_admins");
    Route::get("/create/admin" , [AdminManagementController::class, "create"])->name("create_admin");
    Route::post("/store/admin" , [AdminManagementController::class, "store"])->name("store_admin");
    Route::get('/edit/admin/{id}', [AdminManagementController::class, 'edit'])->name('edit_admin');
    Route::put('/update/admin/{id}', [AdminManagementController::class, 'update'])->name('update_admin');
    Route::delete('/delete/admin/{id}', [AdminManagementController::class, 'destroy'])->name('delete_admin');

    Route::get("/select_category", [AssignCoursesController::class , "index"])->name("select_category");
    Route::get("/view/level/for/category/{id}", [AssignCoursesController::class , "show"])->name("view_level_for_category");
    Route::get('/assign/courses/for/level', [AssignCoursesController::class, 'assign'])->name('go_to_assign_courses');
    Route::post('/assign/courses', [AssignCoursesController::class, 'store'])->name('assign_courses');

});

Route::get("/dashboard/admin" , [AdminDashboardController::class, "index"])->name("dashboard_admin");

Route::post("/logout" , [LoginController::class, "destroy"])->name("logout_super_admin");
