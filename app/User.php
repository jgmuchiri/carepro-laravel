<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        'stripe_managed_account_id', 'stripe_secret_key', 'stripe_publishable_key',
    ];

    /**
     * Store attributes and their casts
     *
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean',
    ];

    /**
     * Attributes that should be treated as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'trial_ends_at',
    ];

    /**
     * Relationship to the address for this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(\App\Models\Addresses\Address::class);
    }

    /**
     * Relationship to the daycare this user belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function daycare()
    {
        return $this->belongsTo(\App\Models\Daycare::class);
    }

    /**
     * Relationship to the DayCare this user owns
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedDaycare()
    {
        return $this->hasMany(\App\Models\Daycare::class, 'owner_user_id');
    }

    /**
     * Relationship to staff record
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function staff()
    {
        return $this->hasOne(\App\Models\Staff::class, 'user_id');
    }

    /**
     * Relationship to parent record
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(\App\Models\ChildParent::class, 'user_id');
    }

    /**
     * Relationship to the roles this user has
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            \App\Models\Permissions\Role::class,
            'roles_to_users',
            'user_id',
            'role_id'
        );
    }

    /**
     * Attribute to get user's role
     *
     * @return \App\Models\Permissions\Role
     */
    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    /**
     * Query scope for where confirmed code
     *
     * @param Builder $query
     * @param string $confirmation_code
     *
     * @return Builder
     */
    public function scopeWhereConfirmationCode(Builder $query, $confirmation_code)
    {
        return $query->where('confirmation_code', '=', $confirmation_code);
    }
}
