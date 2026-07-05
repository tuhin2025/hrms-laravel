<?php

use App\Http\Controllers\ExternalApiController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

use App\Http\Controllers\OraclehrController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeAttendance;
use App\Http\Controllers\EmployeeLeave;
use App\Http\Controllers\JobsControllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

Route::prefix('auth')->name('auth.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth'])->prefix('hr')->name('hr.')->group(function () {

    Route::get('/', [OraclehrController::class, 'index'])->name('index');
//    Route::get('/notification', [NotificationController::class, 'notification'])->name('notification');
    Route::get('/read/{id}', [NotificationController::class, 'read'])->name('notification-read');
    Route::get('/dept-list', [OraclehrController::class, 'deptList'])->name('dept-list');
    Route::post('/dept-store', [OraclehrController::class, 'deptStore'])->name('dept-store');
    Route::get('/dept-edit/{id}', [OraclehrController::class, 'deptEdit'])->name('dept-edit');
    Route::put('/dept-update/{id}', [OraclehrController::class, 'deptUpdate'])->name('dept-update');
    Route::delete('/dept-delete/{id}', [OraclehrController::class, 'deptDelete'])->name('dept-delete');

    Route::get('/job-type-data', [OraclehrController::class, 'jobTypeData'])->name('job-type-data');

});


Route::middleware(['auth'])->prefix('employee')->name('employee.')->group(function () {

    Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('index');
    Route::post('/emp-store', [EmployeeController::class, 'empStore'])->name('emp-store');
    Route::get('/emp-edit/{id}', [EmployeeController::class, 'empEdit'])->name('emp-edit');
    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
    Route::delete('/emp-delete/{id}', [EmployeeController::class, 'empDelete'])->name('emp-delete');
});


Route::middleware(['auth'])->prefix('attendance')->name('attendance.')->group(function () {

    Route::get('/', [EmployeeAttendance::class, 'index'])->name('index');
    Route::post('/attn-store', [EmployeeAttendance::class, 'bulkStore'])->name('attn-store');
//    Route::get('/emp-edit/{id}', [EmployeeController::class, 'empEdit'])->name('emp-edit');
//    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
//    Route::delete('/emp-delete/{id}', [EmployeeController::class, 'empDelete'])->name('emp-delete');
});


Route::middleware(['auth'])->prefix('attendance')->name('attendance.')->group(function () {

    Route::get('/', [EmployeeAttendance::class, 'index'])->name('index');
    Route::post('/attn-store', [EmployeeAttendance::class, 'bulkStore'])->name('attn-store');
//    Route::get('/emp-edit/{id}', [EmployeeController::class, 'empEdit'])->name('emp-edit');
//    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
//    Route::delete('/emp-delete/{id}', [EmployeeController::class, 'empDelete'])->name('emp-delete');
});

Route::middleware(['auth'])->prefix('leave')->name('leave.')->group(function () {

    Route::get('/', [EmployeeLeave::class, 'index'])->name('index');
    Route::get('/emp-search', [EmployeeLeave::class, 'searchEmp'])->name('emp-search');
    Route::post('/leave-store', [EmployeeLeave::class, 'leaveStore'])->name('store');
    Route::get('/leave-data', [EmployeeLeave::class, 'leaveData'])->name('view-data');
//    Route::get('/emp-edit/{id}', [EmployeeController::class, 'empEdit'])->name('emp-edit');
//    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
//    Route::delete('/emp-delete/{id}', [EmployeeController::class, 'empDelete'])->name('emp-delete');
});

Route::middleware(['auth'])->prefix('job')->name('job.')->group(function () {
    Route::get('/', [JobsControllers::class, 'index'])->name('index');
    Route::get('/jobs-edit/{id}', [JobsControllers::class, 'edit'])->name('jobs-edit');
    Route::post('/jobs-store', [JobsControllers::class, 'store'])->name('jobs-store');
    Route::delete('/jobs-delete/{id}', [JobsControllers::class, 'delete'])->name('jobs-delete');
    Route::put('/jobs-update/{id}', [JobsControllers::class, 'update'])->name('jobs-update');
});




Route::prefix('external-api')->name('external.')->group(function () {
    Route::get('/users', [ExternalApiController::class, 'getUsers'])->name('users');


});
