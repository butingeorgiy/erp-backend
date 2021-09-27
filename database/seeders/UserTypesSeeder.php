<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            [
                'id' => 1,
                'name' => 'Physical Recruiter',
            ],
            [
                'id' => 2,
                'name' => 'Legal Recruiter',
            ],
            [
                'id' => 3,
                'name' => 'Employer',
            ],
            [
                'id' => 4,
                'name' => 'Moderator',
            ],
            [
                'id' => 5,
                'name' => 'Administrator'
            ]
        ]);
    }
}
