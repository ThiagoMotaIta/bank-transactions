<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Transfer amount from a wallet to another
     *
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {

        $walletPayer = Wallet::find(auth()->user()->id)

        // Verify if payer has enough amount to transfer
        if (0.00 < $walletPayer->value <= $request->value) {
            
            // Insert new Transaction
            $walletPayer = Wallet::where('user_id', $request->payer);
            $transferPayer = new Transaction;
            $transferPayer->value = $request->value;
            $transferPayer->wallet_id = $walletPayer->id;
            $transferPayer->user_id = $request->payer;
            $transferPayer->save();

            // Increase payee wallet
            $walletPayee = Wallet::where('user_id', $request->payee);
            $walletPayee->value = $walletPayee->values + $request->value;
            $transferPayer->save();

            return response()->json([
                "message" => "Transaction successfuly done!"
            ], 200);
        } else {
            return response()->json([
                "message" => "You don't have enough amount in your wallet"
            ], 404);

        }
    }
}
