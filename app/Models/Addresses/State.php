<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    protected $table = 'states';

    protected $fillable = ['name', 'abbreviation'];

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
     * @param Builder $query,
     * @param string $abbreviation
     */
    public function scopeWhereAbbreviation(Builder $query, $abbreviation)
    {
        $query->where('abbreviation', '=', $abbreviation);
    }
}
