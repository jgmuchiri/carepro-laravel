<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodType extends Model
{
    use SoftDeletes;

    protected $table = 'blood_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['blood_type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['blood_type_label'];

    public function getBloodTypeLabelAttribute($value)
    {
        return __($this->blood_type);
    }
}
