<?php

namespace App\Models\Traits;

use App\Models\PhysicalRecruiterData;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasPhysicalRecruiterFunctionality
{
    # Scopes

    /**
     * Return physical recruiter data relation.
     *
     * @return HasOne
     */
    public function physicalRecruiterData(): HasOne
    {
        return $this->hasOne(PhysicalRecruiterData::class);
    }
}