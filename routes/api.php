<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// https://gateway.24seven.co.ke/api/payments/c2b-confirmation
Route::any('/payments/c2b-confirmation', [App\Http\Controllers\TransactionController::class, 'c2b_confirmation'])->name('c2b_confirmation');
Route::any('/payments/c2b-validation', [App\Http\Controllers\TransactionController::class, 'c2b_validation'])->name('c2b_validation');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
