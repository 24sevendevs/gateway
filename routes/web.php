<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
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
        $amount = 0;
        foreach (Transaction::whereNull("app_id")->get() as $transaction) {
            $accountNumber = preg_replace('/\s+/', '', $transaction->BillRefNumber); //remove white space
            $delimeters = ["#", "-", "_"];
            $selectedDelimeter = "#";
            foreach ($delimeters as $delimeter) {
                if (strpos($accountNumber, $delimeter) !== false) {
                    $selectedDelimeter = $delimeter;
                }
            }
            $accountNumberArray = explode($selectedDelimeter, $accountNumber);
            $code = strtolower($accountNumberArray[0]);
            $n = 0;
            if ($code != "xww" &&  $code != "xwe" && strtolower($accountNumber) != "schemes") {
                $amount += $transaction->TransAmount;
                $n++;
                print("Account no: $transaction->BillRefNumber, Amount: $transaction->TransAmount <br>");
            }
        }
        dd($amount);
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/complete-failed-transactions', [App\Http\Controllers\TransactionController::class, 'complete_failed_transactions'])->name('complete_failed_transactions');
    Route::get('/register-urls', [App\Http\Controllers\TransactionController::class, 'register_c2b_urls'])->name('register_c2b_urls');
    Route::resource('apps', AppController::class);
    Route::resource('transactions', TransactionController::class);

    Route::get('/check-deposit-transactions', [App\Http\Controllers\TransactionController::class, 'showCheckDeposit'])->name('admin.show_check_deposits');
    Route::post('/check-deposit-transactions', [App\Http\Controllers\TransactionController::class, 'checkDeposit'])->name('admin.check_deposits');
});
