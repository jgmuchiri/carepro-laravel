<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $table = 'cities';

    protected $fillable = ['name'];

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
}
