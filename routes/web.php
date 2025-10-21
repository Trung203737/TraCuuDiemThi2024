<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TopController;
Route::get('/top-group-a', [TopController::class, 'index'])->name('top.groupA');
Route::get('/', [StudentController::class, 'index'])->name('scores.index');
Route::post('/search', [StudentController::class, 'search'])->name('scores.search');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');

