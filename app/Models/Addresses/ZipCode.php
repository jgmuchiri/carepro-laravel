<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZipCode extends Model
{
    use SoftDeletes;

    protected $table = 'zip_codes';

    protected $fillable = ['zip_code'];

    /**
     * Query scope for where zipcode
     *
     * @param Builder $query
     * @param string $zip_code
     */
    public function scopeWhereZipCode(Builder $query, $zip_code)
    {
        $query->where('zip_code', '=', $zip_code);
    }
}
