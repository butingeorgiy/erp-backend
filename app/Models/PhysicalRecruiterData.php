<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string first_name
 * @property string last_name
 * @property string|null middle_name
 * @property string|null phone_number
 * @property int city_id
 * @property string|null birthday
 * @property string|null sex
 * @property int|null nationality_id
 * @property string|null professional_courses
 */
class PhysicalRecruiterData extends Model
{
    public $timestamps = false;

    protected $guarded = [];
}
