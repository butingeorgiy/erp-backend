<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class MinimalDatabaseDataTest extends TestCase
{
    public function test_user_types_table(): void
    {
        $this->assertDatabaseHas('user_types', [
            'id' => User::$PHYSICAL_RECRUITER_TYPE_ID,
            'name' => 'Physical Recruiter'
        ]);

        $this->assertDatabaseHas('user_types', [
            'id' => User::$LEGAL_RECRUITER_TYPE_ID,
            'name' => 'Legal Recruiter'
        ]);

        $this->assertDatabaseHas('user_types', [
            'id' => User::$EMPLOYER_TYPE_ID,
            'name' => 'Employer'
        ]);

        $this->assertDatabaseHas('user_types', [
            'id' => User::$MODERATOR_TYPE_ID,
            'name' => 'Moderator'
        ]);

        $this->assertDatabaseHas('user_types', [
            'id' => User::$ADMIN_TYPE_ID,
            'name' => 'Administrator'
        ]);
    }

    public function test_user_statuses_table(): void
    {
        $this->assertDatabaseHas('user_statuses', [
            'id' => User::$NORMAL_STATUS_ID,
            'name' => 'Normal'
        ]);
    }

    public function test_roles_table(): void
    {
        $this->assertDatabaseHas('roles', [
            'id' => Role::$RECRUITER_ROLE_ID,
            'alias' => 'recruiter'
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => Role::$EMPLOYER_ROLE_ID,
            'alias' => 'employer'
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => Role::$MODERATOR_ROLE_ID,
            'alias' => 'moderator'
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => Role::$ADMIN_ROLE_ID,
            'alias' => 'admin'
        ]);
    }
}
