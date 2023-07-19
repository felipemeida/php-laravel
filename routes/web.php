<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/cadastrar', [ DocumentController::class, 'create' ])->name('document.create');
Route::get('/', [ DocumentController::class, 'index' ])->name('document.index');
Route::get('/fila', [ DocumentController::class, 'indexQueue' ])->name('document.indexQueue');
Route::post('/cadastrar',[ DocumentController::class, 'store' ])->name('document.store');
Route::get('/start-queue',[ DocumentController::class, 'startQueue' ])->name('document.startQueue');