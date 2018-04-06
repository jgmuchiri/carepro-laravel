<?php

namespace App\Models\HealthProviders;

use Illuminate\Database\Eloquent\Model;

class HealthProvider extends Model
{
    protected $table = 'health_providers';

    protected $fillable = ['name', 'remarks'];

    /**
     * Relationship to the address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(\App\Models\Addresses\Address::class);
    }

    /**
     * Relationship to the role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\HealthProviders\Role::class, 'health_provider_role_id');
    }

    /**
     * Relationship to the child
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child()
    {
        return $this->belongsTo(\App\Models\Child::class);
    }
}
