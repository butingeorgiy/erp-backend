<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_statuses')->insert([
            [
                'id' => 1,
                'name' => 'Normal'
            ]
        ]);
    }
}
