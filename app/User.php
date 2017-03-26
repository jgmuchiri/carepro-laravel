<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Relationship to the trial plan selected for this user. Since all trials are
     * the same, this is mostly used just so when they click to subscribe they don't have to reselect
     * the plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trialPlan()
    {
        return $this->belongsTo(\App\Models\Subscriptions\Plan::class, 'trial_plan_id');
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
}
