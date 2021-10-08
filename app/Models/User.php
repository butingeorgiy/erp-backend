<?php

namespace App\Models;

use App\Models\Traits\HasPhysicalRecruiterFunctionality;
use App\Services\AuthenticationServices\Traits\HasTokens;
use App\Services\AuthenticationServices\Traits\HasUniqueHashing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string email
 * @property int email_verified
 * @property string password
 * @property int type_id
 * @property int status_id
 * @property int|null profile_photo_id
 * @property string created_at
 * @property string|null deleted_at
 *
 * @property UserType|null type
 * @property PhysicalRecruiterData|null $physicalRecruiterData
 *
 * @method static Builder byEmail(string $email) Retrieve user by email
 *
 * @mixin Builder
 */
class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    use HasTokens;
    use HasUniqueHashing;
    use HasPhysicalRecruiterFunctionality;

    # User types IDs

    public static int $PHYSICAL_RECRUITER_TYPE_ID = 1;
    public static int $LEGAL_RECRUITER_TYPE_ID = 2;
    public static int $EMPLOYER_TYPE_ID = 3;
    public static int $MODERATOR_TYPE_ID = 4;
    public static int $ADMIN_TYPE_ID = 5;

    # User statuses IDs

    public static int $NOT_VERIFIED_STATUS_ID = 1;
    public static int $VERIFIED_STATUS_ID = 2;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'email_verified' => 'boolean'
    ];


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

    /**
     * Return user's email verification relation.
     *
     * @return HasOne
     */
    public function emailVerification(): HasOne
    {
        return $this->hasOne(EmailVerification::class);
    }

    # Scopes

    /**
     * Add condition for retrieving by email.
     *
     * @param Builder $query
     * @param string $email
     * @return Builder
     */
    public function scopeByEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', $email);
    }
}
