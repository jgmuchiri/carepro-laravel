<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;

class IncidentType extends Model
{
    protected $table = 'incident_types';

    protected $fillable = ['name'];
}
