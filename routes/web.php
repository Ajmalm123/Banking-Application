<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('deposit', [DepositController::class, 'create'])->name('deposit');
    Route::post('deposit', [DepositController::class, 'store'])->name('deposit.store'); 
    Route::get('withdraw', [WithdrawController::class, 'create'])->name('withdraw');
    Route::post('withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');
    Route::get('transfer', [TransferController::class, 'create'])->name('transfer');
    Route::post('transfer', [TransferController::class, 'store'])->name('transfer.store');
    Route::get('statement', [StatementController::class, 'index'])->name('statement');
});

require __DIR__.'/auth.php';
