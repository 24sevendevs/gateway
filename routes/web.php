<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route("home");
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/complete-failed-transactions', [App\Http\Controllers\TransactionController::class, 'complete_failed_transactions'])->name('complete_failed_transactions');
    Route::resource('apps', AppController::class);
    Route::resource('transactions', TransactionController::class);

    Route::get('/check-deposit-transactions', [App\Http\Controllers\TransactionController::class, 'showCheckDeposit'])->name('admin.show_check_deposits');
    Route::post('/check-deposit-transactions', [App\Http\Controllers\TransactionController::class, 'checkDeposit'])->name('admin.check_deposits');
});
