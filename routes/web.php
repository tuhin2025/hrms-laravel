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

Route::prefix('hr')->name('hr.')->group(function () {
    Route::get('/', [OraclehrController::class, 'index'])->name('index');
    Route::get('/dept-list', [OraclehrController::class, 'deptList'])->name('dept-list');

    Route::post('/dept-store', [OraclehrController::class, 'deptStore'])->name('dept-store');

    Route::get('/dept-edit/{id}', [OraclehrController::class, 'deptEdit'])->name('dept-edit');

    Route::post('/dept-update/{id}', [OraclehrController::class, 'deptUpdate'])->name('dept-update');

    Route::get('/dept-delete/{id}', [OraclehrController::class, 'deptDelete'])->name('dept-delete');
});




