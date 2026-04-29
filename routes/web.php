<?php

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

Route::prefix('hr')->name('hr.')->group(function () {

    Route::get('/', [OraclehrController::class, 'index'])->name('index');
    Route::get('/dept-list', [OraclehrController::class, 'deptList'])->name('dept-list');
    Route::post('/dept-store', [OraclehrController::class, 'deptStore'])->name('dept-store');
    Route::get('/dept-edit/{id}', [OraclehrController::class, 'deptEdit'])->name('dept-edit');
    Route::put('/dept-update/{id}', [OraclehrController::class, 'deptUpdate'])->name('dept-update');
    Route::delete('/dept-delete/{id}', [OraclehrController::class, 'deptDelete'])->name('dept-delete');
});


Route::prefix('employee')->name('employee.')->group(function () {

    Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('index');
    Route::post('/emp-store', [EmployeeController::class, 'empStore'])->name('emp-store');
    Route::get('/emp-edit/{id}', [EmployeeController::class, 'empEdit'])->name('emp-edit');
    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
    Route::delete('/emp-delete/{id}', [EmployeeController::class, 'empDelete'])->name('emp-delete');
});


Route::prefix('attendance')->name('attendance.')->group(function () {

    Route::get('/', [EmployeeAttendance::class,'index'])->name('index');
    Route::post('/attn-store', [EmployeeAttendance::class, 'bulkStore'])->name('attn-store');
//    Route::get('/emp-edit/{id}', [EmployeeController::class, 'empEdit'])->name('emp-edit');
//    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
//    Route::delete('/emp-delete/{id}', [EmployeeController::class, 'empDelete'])->name('emp-delete');
});
