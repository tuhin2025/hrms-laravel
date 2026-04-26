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

Route::prefix('hr')->name('hr.')->group(function () {

    Route::get('/', [OraclehrController::class, 'index'])->name('index');

    Route::get('/dept-list', [OraclehrController::class, 'deptList'])->name('dept-list');

    Route::post('/dept-store', [OraclehrController::class, 'deptStore'])->name('dept-store');

    Route::get('/dept-edit/{id}', [OraclehrController::class, 'deptEdit'])->name('dept-edit');

    // ✅ FIXED (POST → PUT)
    Route::put('/dept-update/{id}', [OraclehrController::class, 'deptUpdate'])->name('dept-update');

    // ✅ FIXED (GET → DELETE)
    Route::delete('/dept-delete/{id}', [OraclehrController::class, 'deptDelete'])->name('dept-delete');
});


Route::prefix('employee')->name('employee.')->group(function () {

    Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('index');

//   Route::get('/dept-list', [OraclehrController::class, 'index'])->name('emp-list');
//
    Route::post('/dept-store', [EmployeeController::class, 'empStore'])->name('emp-store');
//
//    Route::get('/dept-edit/{id}', [OraclehrController::class, 'deptEdit'])->name('dept-edit');
//
//    // ✅ FIXED (POST → PUT)
    Route::put('/emp-update/{id}', [EmployeeController::class, 'empUpdate'])->name('emp-update');
//
//    // ✅ FIXED (GET → DELETE)
//    Route::delete('/dept-delete/{id}', [OraclehrController::class, 'deptDelete'])->name('dept-delete');
});
