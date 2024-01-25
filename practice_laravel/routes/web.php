<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLTEController;
use App\Http\Controllers\AdminLTEStudentController;
use App\Http\Controllers\StudentController;
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
    return view('login.login');
});

Route::prefix('adminlte')->middleware('login_auth')->group(function () {
    Route::get('/index', [AdminLTEController::class, 'index'])->name('admin.index');
    Route::get('/student', [AdminLTEStudentController::class, 'student'])->name('adminlte.student');
    Route::get('/student/create', [AdminLTEStudentController::class, 'create'])->name('adminlte.create');
    Route::post('/student/create', [AdminLTEStudentController::class, 'store'])->name('adminlte.store');
    Route::get('/student/{student}', [AdminLTEStudentController::class, 'show'])->name('adminlte.show');
    Route::get('/student/{student}/edit', [AdminLTEStudentController::class, 'edit'])->name('adminlte.edit');
    Route::patch('/student/{student}', [AdminLTEStudentController::class, 'update'])->name('adminlte.update');
    Route::delete('/student/{student}', [AdminLTEStudentController::class, 'destroy'])->name('adminlte.destroy');
});

Route::get('/student/create', [StudentController::class, 'create'])->name('student.create')->middleware('login_auth');

Route::post('/student/create', [StudentController::class, 'store'])->name('student.store')->middleware('login_auth');

Route::get('/student', [StudentController::class, 'index'])->name('student.index')->middleware('login_auth');

Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show')->middleware('login_auth');

Route::get('/student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit')->middleware('login_auth');

Route::patch('/student/{student}', [StudentController::class, 'update'])->name('student.update')->middleware('login_auth');

Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy')->middleware('login_auth');


Route::get('/login', [AdminController::class, 'index'])->name('login.index');
Route::get('/logout', [AdminController::class, 'logout'])->name('login.logout');
Route::post('/login', [AdminController::class, 'process'])->name('login.process');
