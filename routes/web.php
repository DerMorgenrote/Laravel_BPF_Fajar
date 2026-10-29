<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});


Route::get('/matakuliah', [MatakuliahController::class, 'index']);

Route::get('/matakuliah/show/{kode?}', [MatakuliahController::class, 'show']);

Route::get('/home',[HomeController::class,'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('pelanggan', PelangganController::class);