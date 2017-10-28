<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_uri', 'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $appends = ['name_label'];

    /**
     * Store attributes and their casts
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
        'is_active' => 'bool'
    ];

    /**
     * Attributes that should be treated as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_of_birth'
    ];

    /**
     * Relationship to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(\App\User::class,'id', 'user_id');
    }

    /**
     * Query scope for where belongs to daycare
     *
     * @param Builder $query
     * @param int $daycare_id
     */
    public function scopeWhereDaycareId(Builder $query, $daycare_id)
    {
        $query->distinct()->select($this->getTable() . '.*')
            ->join('users', 'users.id', '=', $this->getTable() . '.user_id')
            ->where('users.daycare_id', '=', $daycare_id);
    }
}
