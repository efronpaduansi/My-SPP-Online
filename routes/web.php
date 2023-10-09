<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LevelSiswaController;
use App\Http\Controllers\Admin\PendapatanController;
use App\Http\Controllers\Admin\TahunAjaranController;


Route::controller(LoginController::class)->group(function(){
    Route::get('/', 'index')->name('auth.index')->middleware('guest');
    Route::get('/login', 'login')->name('auth.login')->middleware('guest');
    Route::post('/login', 'authenticate')->name('auth.authenticate')->middleware('guest');
    Route::post('/logout', 'logout')->name('auth.logout')->middleware('auth');
});


Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::controller(KelasController::class)->group(function(){
        Route::get('kelas', 'index')->name('kelas.index');
        Route::post('kelas', 'store')->name('kelas.store');
        Route::put('kelas/{id}', 'update')->name('kelas.update');
        Route::delete('kelas/{id}', 'destroy')->name('kelas.destroy');
    });

    Route::controller(TahunAjaranController::class)->group(function(){
        Route::get('tahun-ajaran', 'index')->name('ta.index');
        Route::post('tahun-ajaran', 'store')->name('ta.store');
        Route::put('tahun-ajaran/{id}', 'update')->name('ta.update');
        Route::delete('tahun-ajaran/{id}', 'destroy')->name('ta.destroy');
    });

    Route::controller(SemesterController::class)->group(function(){
        Route::get('semester', 'index')->name('semester.index');
        Route::post('semester', 'store')->name('semester.store');
        Route::get('semester/close/{id}', 'closeSemester')->name('semester.close');
        Route::put('semester/{id}', 'update')->name('semester.update');
        Route::delete('semester/{id}', 'destroy')->name('semester.destroy');
    });

    Route::controller(LevelSiswaController::class)->group(function(){
        Route::get('level', 'index')->name('level.index');
        Route::post('level', 'store')->name('level.store');
        Route::put('level/{id}', 'update')->name('level.update');
        Route::delete('level/{id}', 'destroy')->name('level.destroy');
    });

    Route::controller(SiswaController::class)->group(function(){
        Route::get('siswa', 'index')->name('siswa.index');
        Route::get('siswa/show/{nis}', 'show')->name('siswa.show');
        Route::get('siswa/create', 'create')->name('siswa.create');
        Route::post('siswa', 'store')->name('siswa.store');
        Route::get('siswa/edit/{nis}', 'edit')->name('siswa.edit');
        Route::put('siswa/{nis}', 'update')->name('siswa.update');
        Route::get('siswa/set-status/{nis}', 'setStudentStatus')->name('siswa.set-status');
        Route::get('siswa/{nis}', 'destroy')->name('siswa.destroy');
    });

    Route::controller(InvoiceController::class)->group(function(){
        Route::get('invoice', 'index')->name('invoice.index');
        Route::get('invoice/create', 'create')->name('invoice.create');
        Route::get('invoice/preview', 'invoicePreview')->name('invoice.preview');
        Route::post('invoice', 'store')->name('invoice.store');
        Route::get('invoice/show/{id}', 'show')->name('invoice.show');
        Route::put('invoice/show/{id}', 'setStatusLunas')->name('invoice.setlunas');
        Route::get('invoice/edit/{id}', 'edit')->name('invoice.edit');
        Route::put('invoice/{id}', 'update')->name('invoice.update');
        Route::get('invoice/{id}', 'destroy')->name('invoice.destroy');
    });

    Route::controller(PaymentController::class)->group(function(){
        Route::get('payment', 'index')->name('payment.index');
        Route::delete('payment/{id}', 'destroy')->name('payment.destroy');
    });

    Route::controller(PendapatanController::class)->group(function(){
        Route::get('pendapatan', 'index')->name('pendapatan.index');
        Route::get('pendapatan/export-pdf', 'exportPDF')->name('pendapatan.export-pdf');
        Route::get('pendapatan/export-data', 'exportData')->name('pendapatan.exportData');
    });

    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile', 'index')->name('profile.index');
        Route::put('/profile/{id}', 'updateProfile')->name('profile.updateProfile');
        Route::put('/profile/password-change/{id}', 'updatePassword')->name('profile.updatePassword');
        Route::delete('/profile/account-delete/{id}', 'deleteAccount')->name('profile.deleteAccount');
    });

    Route::controller(StaffController::class)->group(function(){
        Route::get('/staff', 'index')->name('staff.index');
        Route::get('/staff/create', 'create')->name('staff.create');
        Route::post('/staff', 'store')->name('staff.store');
        Route::get('/staff/{id}/edit', 'edit')->name('staff.edit');
        Route::put('/staff/{id}', 'update')->name('staff.update');
        Route::delete('/staff/{id}', 'destroy')->name('staff.destroy');
    });

});

