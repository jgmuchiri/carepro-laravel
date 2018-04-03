<?php

namespace App\Models\HealthProviders;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'health_provider_roles';

    protected $fillable = ['name'];
}
