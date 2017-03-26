<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';

    protected $fillable = ['name'];

    /**
     * Query scope for where the plan name is
     *
     * @param Builder $query
     * @param string $name
     */
    public function scopeWhereName(Builder $query, $name)
    {
        $query->where('name', '=', $name);
    }
}
