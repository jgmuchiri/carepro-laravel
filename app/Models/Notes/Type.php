<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    protected $table = 'note_types';

    protected $fillable = ['name'];
}
