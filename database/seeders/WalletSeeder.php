<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Client 1
        Wallet::create([
            'user_id' => 1,
            'value' => 500.00,
        ]);

        // Create Saler 1
        Wallet::create([
            'user_id' => 2,
            'value' => 0.00,
        ]);
    }
}
