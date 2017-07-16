<?php

namespace App\Models\Groups;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'short_description',
        'daycare_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Store attributes and their casts
     *
     * @var array
     */
    protected $casts = [
        'daycare_id' => 'int'
    ];

    /**
     * Relationship to this group's children
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany(
            \App\Models\Child::class,
            'groups_to_children',
            'group_id',
            'child_id'
        );
    }

    /**
     * Relationship to this group's staff
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function staff()
    {
        return $this->belongsToMany(
            \App\Models\Staff::class,
            'groups_to_staff',
            'group_id',
            'staff_id'
        );
    }

    /**
     * Query scope for where belongs to daycare
     *
     * @param Builder $query
     * @param int $daycare_id
     */
    public function scopeWhereDaycareId(Builder $query, $daycare_id)
    {
        $query->where('daycare_id', '=', $daycare_id);
    }
}
