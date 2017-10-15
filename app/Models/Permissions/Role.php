<?php

namespace App\Models\Permissions;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const ADMIN_ROLE = 'Admin';
    const TENANT_ROLE = 'Tenant';
    const STAFF_ROLE = 'Staff';
    const PARENT_ROLE = 'Parent';

    protected $table = 'roles';

    protected $fillable = ['name', 'is_user_editable'];

    protected $casts = [
        'is_user_editable' => 'boolean',
        'daycare_id' => 'int'
    ];

    protected $appends = [
        'can_edit',
        'can_delete'
    ];

    /**
     * Relationship to the permissions table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(
            \App\Models\Permissions\Permission::class,
            'roles_to_permissions',
            'role_id',
            'permission_id'
        );
    }

    /**
     * Relationship to the users that have this role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            \App\User::class,
            'roles_to_users',
            'role_id',
            'user_id'
        );
    }

    /**
     * Relationship to the daycare this role belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daycare()
    {
        return $this->belongsTo(\App\Models\Daycare::class);
    }

    /**
     * Query scope for where name equals passed in name
     *
     * @param Builder $query
     * @param string $name
     */
    public function scopeWhereName(Builder $query, $name)
    {
        $query->where('name', '=', $name);
    }

    /**
     * Query scope for where role is user editable
     *
     * @param Builder $query
     */
    public function scopeWhereIsUserEditable(Builder $query)
    {
        $query->where('is_user_editable', '=', true);
    }

    /**
     * Query scope for where belongs to daycare
     *
     * @param Builder $query
     */
    public function scopeWhereDaycareId(Builder $query, $daycare_id)
    {
        $query->where('daycare_id', '=', $daycare_id);
    }

    /**
     * Query scope for where user can edit role
     *
     * @param Builder $query
     * @param User $user
     */
    public function scopeWhereUserCanEdit(Builder $query, User $user)
    {
        $query->whereIsUserEditable()->whereDaycareId($user->daycare->id);
    }

    public function getCanEditAttribute()
    {
        return \Auth::user()->can('edit', $this);
    }

    public function getCanDeleteAttribute()
    {
        return \Auth::user()->can('update', $this);
    }
}
