<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Client 1
        User::create([
            'name' => 'Thiago Mota',
            'email' => 'thiagomotaita1@gmail.com',
            'type' => 'C',
            'password' => bcrypt('qwer1234'),
        ]);

        // Create Saler 1
        User::create([
            'name' => 'Lojista 1',
            'email' => 'loj@logista1.com.br',
            'type' => 'S',
            'password' => bcrypt('qwer1234'),
        ]);
    }
}
