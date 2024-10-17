<?php
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rute untuk pengguna yang tidak login
Route::middleware(['isNotLogin'])->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

// Rute untuk pengguna yang sudah login
Route::middleware(['isLogin'])->group(function(){
    Route::get('/home', [Controller::class, 'home'])->name('home');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware(['isAdmin'])->group(function(){

    // Rute untuk data siswa, dapat diakses oleh semua pengguna yang login
    Route::prefix('/student')->name('student.')->group(function(){
        Route::get('/', [StudentController::class, 'index'])->name('home'); // Semua pengguna bisa mengakses ini
        Route::get('/create', [StudentController::class, 'create'])->name('create')->middleware('isAdmin'); // Hanya admin
        Route::post('/store', [StudentController::class, 'store'])->name('store')->middleware('isAdmin'); // Hanya admin
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit')->middleware('isAdmin'); // Hanya admin
        Route::patch('/edit/{id}', [StudentController::class, 'update'])->name('update')->middleware('isAdmin'); // Hanya admin
        Route::delete('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy')->middleware('isAdmin'); // Hanya admin
    });

    // Rute untuk pengelolaan akun, hanya dapat diakses oleh admin
        Route::prefix('/user')->name('user.')->group(function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/edit/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        });
    });
    Route::get('attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('attendances/index', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('attendances/{id}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::patch('attendances/{id}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('attendances/{id}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
});
