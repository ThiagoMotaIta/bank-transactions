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

        $walletPayer = Wallet::where('user_id', $request->payer_id)->get();
            
            // Insert new Transaction for payer
            $walletPayer = Wallet::where('user_id', $request->payer_id)->get();
            $transferPayer = new Transaction;
            $transferPayer->value = $request->value;
            $transferPayer->wallet_id = $request->payer_id;
            $transferPayer->type = "D";
            $transferPayer->save();

            // Insert new Transaction for payee
            $walletPayee = Wallet::where('user_id', $request->payee_id)->get();
            $transferPayee = new Transaction;
            $transferPayee->value = $request->value;
            $transferPayee->wallet_id = $request->payee_id;
            $transferPayee->type = "R";
            $transferPayee->save();

            // Increase payee wallet
            //$walletPayee->value = $walletPayee->value + $request->value;
            //$walletPayee->save();

            // Decrease payer wallet
            //$walletPayer->value = $walletPayer->value - $request->value;
            //$walletPayer->save();

            return response()->json([
                "message" => "Transação realizada com sucesso!"
            ], 200);
        
    }
}
