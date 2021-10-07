<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type_has_role')->insert([
            [
                'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID,
                'role_id' => Role::$RECRUITER_ROLE_ID
            ],
            [
                'type_id' => User::$LEGAL_RECRUITER_TYPE_ID,
                'role_id' => Role::$RECRUITER_ROLE_ID
            ],
            [
                'type_id' => User::$EMPLOYER_TYPE_ID,
                'role_id' => Role::$EMPLOYER_ROLE_ID
            ],
            [
                'type_id' => User::$ADMIN_TYPE_ID,
                'role_id' => Role::$ADMIN_ROLE_ID
            ]
        ]);
    }
}
