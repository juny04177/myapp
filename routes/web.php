<?php

use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [WordController::class, 'index'])->name('words.index');
Route::post('/index', [WordController::class, 'store'])->name('words.store');
Route::get('/index/{no}/edit', [WordController::class, 'edit'])
    ->whereNumber('no')
    ->name('words.edit');
Route::put('/index/{no}', [WordController::class, 'update'])
    ->whereNumber('no')
    ->name('words.update');
Route::delete('/index/{no}', [WordController::class, 'destroy'])
    ->whereNumber('no')
    ->name('words.destroy');
