<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Daycare extends Model
{
    use SoftDeletes;

    protected $table = 'daycares';

    protected $fillable = ['name', 'employee_tax_identifier'];

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
}
