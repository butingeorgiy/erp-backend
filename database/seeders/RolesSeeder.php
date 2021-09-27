<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Recruiter',
                'alias' => 'recruiter'
            ],
            [
                'id' => 2,
                'name' => 'Employer',
                'alias' => 'employer'
            ],
            [
                'id' => 3,
                'name' => 'Moderator',
                'alias' => 'moderator'
            ],
            [
                'id' => 4,
                'name' => 'Administrator',
                'alias' => 'admin'
            ]
        ]);
    }
}
