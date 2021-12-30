<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(DB::table('Role')->count() == 0){

            DB::table('Role')->insert([

                [
                    'role_name' => 'superadmin',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'role_name' => 'admin',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'role_name' => 'inventory manager',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                	'role_name' => 'order manager',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                ],
                [
                	'role_name' => 'Customer',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                ]

            ]);
            
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
