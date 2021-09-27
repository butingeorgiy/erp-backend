<?php

namespace App\Models;

use App\Services\AuthenticateService\Traits\HasTokens;
use App\Services\AuthenticateService\Traits\HasUniqueHashing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string email
 * @property string password
 * @property int type_id
 * @property int status_id
 * @property int|null profile_photo_id
 * @property string created_at
 * @property string|null deleted_at
 *
 * @property UserType|null type
 *
 * @mixin Builder
 */
class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    use HasTokens;
    use HasUniqueHashing;

    # User types IDs

    public static int $PHYSICAL_RECRUITER_TYPE_ID = 1;
    public static int $LEGAL_RECRUITER_TYPE_ID = 2;
    public static int $EMPLOYER_TYPE_ID = 3;
    public static int $MODERATOR_TYPE_ID = 4;
    public static int $ADMIN_TYPE_ID = 5;

    # User statuses IDs

    public static int $NORMAL_STATUS_ID = 1;

    public $timestamps = false;


    # Relations

    /**
     * Return user's tokens' relations.
     *
     * @return HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(AuthToken::class);
    }

    /**
     * Return user's types' relations.
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }

    # Other methods


}
