<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

class Daycare extends Model
{
    use Billable;
    use SoftDeletes;

    protected $table = 'daycares';

    protected $fillable = ['name', 'employee_tax_identifier'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'trial_ends_at'
    ];

    /**
     * Relationship to the address for this daycare
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(\App\Models\Addresses\Address::class);
    }

    /**
     * Relationship to the user that owns this daycare
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'owner_user_id');
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
     * Get the managed account record associated with the daycare.
     */
    public function managed_account()
    {
        return $this->hasOne('App\Models\DaycareManagedAccount');
    }
}
