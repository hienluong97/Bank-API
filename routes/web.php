<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;

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


Route::get('/', [BankController::class, 'index'])->name('index');

Route::get('/corporation-info', [BankController::class, 'getCorporationInfo'])->name('getCorporationInfo');
Route::get('/corporation-users', [BankController::class, 'getCorporationUsers'])->name('getCorporationUsers');
Route::get('/create-request-transfer', [BankController::class, 'createRequestTransfer'])->name('createRequestTransfer');
Route::get('/show-list-request-transfer', [BankController::class, 'showListRequestTransfer'])->name('showListRequestTransfer');
Route::post('/store-transfer', [BankController::class, 'storeTransfer'])->name('storeTransfer');
Route::post('/confirm-transaction', [BankController::class, 'confirmTransaction'])->name('confirmTransaction');
