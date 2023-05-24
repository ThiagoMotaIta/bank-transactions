<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\WalletController;
use App\Http\Controllers\api\TransactionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List my Wallet
Route::get('my-wallet', [WalletController::class, 'getWallet']);

// Transfer amount from a wallet to another one (1-1)
Route::post('transfer', [TransactionController::class, 'transfer']);
