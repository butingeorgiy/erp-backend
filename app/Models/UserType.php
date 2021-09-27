<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class UserType extends Model
{
    public $timestamps = false;

    # Relations

    /**
     * Return type's roles' relations.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'user_type_has_role',
            'type_id',
            'role_id'
        );
    }
}
