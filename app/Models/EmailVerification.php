<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user;
 *
 * @mixin Builder
 */
class EmailVerification extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $guarded = [];


    # Relations

    /**
     * Return email verification's user relation.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
