<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'check_in_date',
        'check_out_date'
    ];

    protected $casts = [
        'check_in_date' => 'datetime',
        'check_out_date' => 'datetime',
        'check_in_pickup_user_id' => 'int',
        'check_out_pickup_user_id' => 'int',
        'check_in_parent_id' => 'int',
        'check_out_parent_id' => 'int'
    ];

    /**
     * Relationship to check in parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkInParent()
    {
        return $this->belongsTo(\App\Models\Child::class, 'check_in_parent_id');
    }

    /**
     * Relationship to check out parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkOutParent()
    {
        return $this->belongsTo(\App\Models\Child::class, 'check_out_parent_id');
    }

    /**
     * Relationship to check out pickup user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkOutPickupUser()
    {
        return $this->belongsTo(\App\Models\Child::class, 'check_out_pickup_user_id');
    }

    /**
     * Relationship to check in pickup user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkInPickupUser()
    {
        return $this->belongsTo(\App\Models\Child::class, 'check_in_pickup_user_id');
    }

    /**
     * Relationship to the child
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child()
    {
        return $this->belongsTo(\App\Models\Child::class, 'child_id');
    }

    public function scopeOnlyLastRecord(Builder $query)
    {
        $query->limit(1)->orderByDesc('created_at');
    }
}
