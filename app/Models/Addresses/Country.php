<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $table = 'countries';

    protected $fillable = ['name', 'abbreviation'];

    protected $appends = ['name_label', 'abbreviation_label'];

    /**
     * Query scope for where name
     *
     * @param Builder $query
     * @param string $name
     */
    public function scopeWhereName(Builder $query, $name)
    {
        $query->where('name', '=', $name);
    }

    /**
     * Query scope for where abbreviation
     *
     * @param Builder $query
     * @param string $abbreviation
     */
    public function scopeWhereAbbreviation(Builder $query, $abbreviation)
    {
        $query->where('abbreviation', '=', $abbreviation);
    }

    public function getNameLabelAttribute($value)
    {
        return __($this->name);
    }

    public function getAbbreviationLabelAttribute($value)
    {
        return __($this->abbreviation);
    }
}
