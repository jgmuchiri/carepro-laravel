<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
    use SoftDeletes;

    protected $table = 'children';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'ssn',
        'dob',
        'pin',
        'photo',
        'gender_id',
        'blood_type_id',
        'status_id',
        'created_by_user_id',
        'updated_by_user_id',
        'religion_id',
        'ethnicity_id'
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
        'gender_id' => 'int',
        'blood_type_id' => 'int',
        'status_id' => 'int',
        'created_by_user_id' => 'int',
        'updated_by_user_id' => 'int',
        'religion_id' => 'int',
        'ethnicity_id' => 'int',
        'is_active' => 'bool'
    ];

    /**
     * Attributes that should be treated as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_of_birth'
    ];

    /**
     * Relationship to this child's parents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parents()
    {
        return $this->belongsToMany(
            \App\Models\ChildParent::class,
            'children_to_parents',
            'child_id',
            'parent_id'
        );
    }

    /**
     * Relationship to this child's groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(
            \App\Models\Groups\Group::class,
            'groups_to_children',
            'child_id',
            'group_id'
        );
    }

    /**
     * Relationship to this child's status
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id');
    }

    /**
     * Query scope for where belongs to daycare
     *
     * @param Builder $query
     * @param int $daycare_id
     */
    public function scopeWhereDaycareId(Builder $query, $daycare_id)
    {
        $query->distinct()->select($this->getTable() . '.*')
            ->join(
            'children_to_parents',
            'children_to_parents.child_id',
            '=',
            $this->getTable() . '.id')
            ->join('parents', 'parents.id', '=', 'children_to_parents.parent_id')
            ->join('users', 'users.id', '=', 'parents.user_id')
            ->where('users.daycare_id', '=', $daycare_id);
    }

    /**
     * Query scope for where belongs to a specific parent
     *
     * @param Builder $query
     * @param int $user_id
     */
    public function scopeWhereParentId(Builder $query, $user_id)
    {
        $query->select($this->getTable() . '.*')
            ->join(
                'children_to_parents',
                'children_to_parents.child_id',
                '=',
                $this->getTable() . '.id')
            ->join('parents', 'parents.id', '=', 'children_to_parents.parent_id')
            ->where('parents.user_id', '=', $user_id);
    }

    /**
     * Query scope for where is pending approval
     *
     * @param Builder $query
     */
    public function scopeWherePendingApproval(Builder $query)
    {
        $query->distinct()->select($this->getTable() . '.*')
            ->join(
                'statuses',
                function ($join) {
                    $join->on('statuses.id', '=', $this->getTable() . '.status_id')
                        ->where('statuses.name', '=', 'Pending Approval');
                }
            );
    }

    /**
     * Query scope for where is assigned to staff member
     *
     * @param Builder $query
     */
    public function scopeWhereAssignedStaffId(Builder $query, $id)
    {
        $query->distinct()->select($this->getTable() . '.*')
            ->join(
                'groups_to_children',
                'groups_to_children.child_id',
                '=',
                $this->getTable() . '.id'
            )->join(
                'groups_to_staff',
                'groups_to_staff.group_id',
                '=',
                'groups_to_children.group_id'
            );
    }
}
