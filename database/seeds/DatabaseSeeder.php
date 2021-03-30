<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'suboy15@gmail.com',
            'password' => bcrypt('joel1234'),
        ]);

        DB::table('customers')->insert([
            'name' =>   'Noya Security Services',
            'zip' =>    '2583BM \'s-Gravenhage',
            'address' =>    'Mennickstraat 73',
            'country' =>    'Nederland',
            'kvk' =>    '0',
            'btw' =>    '0',
            'phone' =>  '0',

        ]);

    }
}
