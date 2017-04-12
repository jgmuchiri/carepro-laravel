<?php

namespace App\Models\Permissions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    const VIEW_TENANT = 'View Tenant';
    const REGISTER_TENANT = 'Register Tenant';
    const EDIT_TENANT = 'Edit Tenant';
    const SEND_PASSWORD_RESET_EMAILS = 'Send Password Reset Emails';
    const SEND_MESSAGES_TO_TENANTS = 'Send Messages to Tenants';
    const MANAGE_SUBSCRIPTIONS = 'Manage Subscriptions';
    const MANAGE_APPLICATION_SETTINGS = 'Manage Application Settings';
    const MANAGE_STAFF_MEMBERS = 'Manage Staff Members';
    const MANAGE_CHILDREN = 'Manage All Children';
    const MANAGE_PARENTS = 'Manage Parents';
    const GENERATE_REPORTS = 'View/Generate Reports';
    const MANAGE_ASSIGNED_CHILDREN = 'Manage Assigned Children';
    const PROCESS_PAYMENTS = 'Process Payments';
    const VIEW_OWN_CHILDREN = 'View Own Children';
    const PAY_INVOICES = 'Pay Invoices';
    const MESSAGE_DAYCARE_Center = 'Message Daycare Center';

    protected $table = 'permissions';

    protected $fillable = ['name', 'is_admin_only'];

    /**
     * Relationship to the roles table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            \App\Models\Permissions\Role::class,
            'roles_to_permissions',
            'permission_id',
            'role_id'
        );
    }

    /**
     * Query scope for where permission is not admin only
     *
     * @param Builder $query
     */
    public function scopeWhereIsNotAdminOnly(Builder $query)
    {
        $query->where('is_admin_only', '=', false);
    }
}
