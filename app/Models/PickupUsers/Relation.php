<?php

namespace App\Models\PickupUsers;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'relations';

    protected $fillable = ['name'];
}
