<?php

namespace Tests\Feature;

use App\Exceptions\AuthTokenNotFoundException;
use App\Exceptions\UserTypeNotFoundException;
use App\Models\User;
use App\Services\AuthenticationServices\Auth;
use App\Services\AuthenticationServices\Drivers\UnitTestingTokenDriver;
use App\Services\AuthenticationServices\Exceptions\FailedToAttachTokenException;
use App\Services\AuthenticationServices\Exceptions\FailedToGetTokenException;
use Tests\TestCase;

class AuthenticationServiceTest extends TestCase
{
    /**
     * Check user's valid auth token with right access to one role.
     *
     * @throws FailedToAttachTokenException
     * @throws AuthTokenNotFoundException
     * @throws UserTypeNotFoundException
     * @throws FailedToGetTokenException
     */
    public function test_check_one_right_role(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID
        ]);

        $splicedToken = explode('|', decrypt($user->attachToken(), false));

        $isUserAuth = Auth::check('recruiter', new UnitTestingTokenDriver($splicedToken[0], $splicedToken[1]));

        $user->forceDelete();

        $this->assertTrue($isUserAuth);
    }

    /**
     * Check user's valid auth token with wrong access to one role.
     *
     * @throws AuthTokenNotFoundException
     * @throws FailedToAttachTokenException
     * @throws FailedToGetTokenException
     * @throws UserTypeNotFoundException
     */
    public function test_check_one_wrong_role(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID
        ]);

        $splicedToken = explode('|', decrypt($user->attachToken(), false));

        $isUserAuth = Auth::check('admin', new UnitTestingTokenDriver($splicedToken[0], $splicedToken[1]));

        $user->forceDelete();

        $this->assertFalse($isUserAuth);
    }

    /**
     * Check user's valid auth token with right and wrong roles.
     *
     * @throws AuthTokenNotFoundException
     * @throws FailedToAttachTokenException
     * @throws FailedToGetTokenException
     * @throws UserTypeNotFoundException
     */
    public function test_check_several_roles(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID
        ]);

        $splicedToken = explode('|', decrypt($user->attachToken(), false));

        $isUserAuth = Auth::check(['admin', 'recruiter'], new UnitTestingTokenDriver($splicedToken[0], $splicedToken[1]));

        $user->forceDelete();

        $this->assertTrue($isUserAuth);
    }

    /**
     * Check user's valid auth token with two wrong roles.
     *
     * @throws AuthTokenNotFoundException
     * @throws FailedToAttachTokenException
     * @throws FailedToGetTokenException
     * @throws UserTypeNotFoundException
     */
    public function test_check_several_wrong_roles(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'type_id' => User::$PHYSICAL_RECRUITER_TYPE_ID
        ]);

        $splicedToken = explode('|', decrypt($user->attachToken(), false));

        $isUserAuth = Auth::check(['employer', 'moderator'], new UnitTestingTokenDriver($splicedToken[0], $splicedToken[1]));

        $user->forceDelete();

        $this->assertFalse($isUserAuth);
    }
}
