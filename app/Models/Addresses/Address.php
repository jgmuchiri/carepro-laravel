<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = ['address_line_1', 'address_line_2', 'phone'];

    /**
     * Relationship to the city for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(\App\Models\Addresses\City::class);
    }

    /**
     * Relationship to the state for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(\App\Models\Addresses\State::class);
    }

    /**
     * Relationship to the zip code for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zipCode()
    {
        return $this->belongsTo(\App\Models\Addresses\ZipCode::class);
    }

    /**
     * Relationship to the users that have this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(\App\Models\Addresses\Address::class);
    }
}
