<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    protected $table = 'notes_to_photos';

    protected $fillable = ['photo_uri'];
}
