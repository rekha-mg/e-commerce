<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
    if(DB::table('users')->count() == 0){

            DB::table('users')->insert([

                [
                    'firstname' => 'Admin',
                    'lastname' => 'admin',
                    'email' => 'theresa12@gmail.com',
                    'password' => 'admin123',
                ],
                

            ]);
            
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
