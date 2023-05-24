<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;

class WalletController extends Controller
{
    /**
     * Show the amount of an especific wallet.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWallet()
    {
        // Get wallet from logged user
        if (Wallet::where('user_id', auth()->user()->id)->exists()) {

            $wallet = Wallet::find(auth()->user()->id);

            // Data payload
            $payload[] = ['id'=>$wallet->id, 'user-id'=>$wallet->user_id, 'value'=>$wallet->value];

            return response()->json([
                "message" => "Wallet found!",
                "payload" => $payload
            ], 200);
        } else {
            return response()->json([
                "message" => "There is an error. Please, check your Wallet and try again."
            ], 404);

        }
    }
}
