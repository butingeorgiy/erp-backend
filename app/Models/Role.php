<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Role extends Model
{
    # Roles IDs

    public static int $RECRUITER_ROLE_ID = 1;
    public static int $EMPLOYER_ROLE_ID = 2;
    public static int $MODERATOR_ROLE_ID = 3;
    public static int $ADMIN_ROLE_ID = 4;

    public $timestamps = false;
}
