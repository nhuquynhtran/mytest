<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$Szc0SW60.ShC63bmJTdw2eYAxIOTdx5GW6gEfFUNe.00dW1Hqob4O',
                'role' => 'admin'
            )
        );
    }
}
