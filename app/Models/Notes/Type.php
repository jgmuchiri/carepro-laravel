<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    protected $table = 'note_types';

    protected $fillable = ['name'];

    protected $appends = ['name_label'];

    /**
     * Attribute for the translated version of the name
     *
     * @param string $value
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    public function getNameLabelAttribute($value)
    {
        return __($this->name);
    }
}
