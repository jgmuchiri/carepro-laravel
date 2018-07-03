<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaycareManagedAccount extends Model
{
    protected $fillable = [
        'stripe_managed_account_id', 'stripe_secret_key', 'stripe_publishable_key', 'daycare_id'
    ];

    /**
     * Get the daycare that owns the managed account.
     */
    public function daycare()
    {
        return $this->belongsTo('App\MOdels\Daycare');
    }
}
