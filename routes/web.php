<?php

use App\Http\Controllers\KontrolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\Authenticated;

Route::group(['middleware' => [Authenticated::class]], function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::group(['middleware'=> [AdminOnly::class]], function () {
        Route::post('qr', [QrController::class,'create'])->name('create-qr');
        Route::delete('qr/{id}', [QrController::class,'destroy'])->name('delete-qr');
        Route::get('qr', [QrController::class,'index'])->name('kelola-qr');
        Route::get('report', [ReportController::class,'index'])->name('report-list');
        Route::delete('report/{id}/delete', [ReportController::class,'delete'])->name('delete-report');
        Route::post('report/download', [ReportController::class,'download'])->name('download-report');
        Route::get('users', [UserController::class,'index'])->name('users.index');
        Route::get('users/{id}/edit', [UserController::class,'showEdit'])->name('users.showedit');
        Route::get('users/add', [UserController::class,'showAdd'])->name('users.showadd');
        Route::post('users/{id}/delete', [UserController::class,'deleteUser'])->name('users.delete');
        Route::put('users/{id}/edit', [UserController::class,'updateUser'])->name('users.update');
        Route::post('users', [UserController::class,'createUser'])->name('users.store');
    });
    Route::get('kontrol', [KontrolController::class,'index'])->name('kontrol-qr');
    Route::post('kontrol-store', [KontrolController::class,'store'])->name('kontrol-store');
    Route::get('qr/{id}', [QrController::class,'getLokasiById'])->name('get-qr');
});
Route::get('/login', [LoginController::class, 'loginView'])->name('login');
Route::post('/login', [LoginController::class, 'loginCheck']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
