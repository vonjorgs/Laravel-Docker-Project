<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;

Route::get('/', [AdController::class, 'index'])->name('ads.index');
Route::post('/refresh', [AdController::class, 'refreshData'])->name('ads.refresh');
