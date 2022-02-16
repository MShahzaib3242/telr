<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CheckoutController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/telr', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/handle-payment/success', [CheckoutController::class, 'success']);
Route::get('/handle-payment/cancel', [CheckoutController::class, 'cancel']);
Route::get('/handle-payment/declined', [CheckoutController::class, 'declined']);

