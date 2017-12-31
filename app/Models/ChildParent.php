<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildParent extends Model
{
    use SoftDeletes;

    protected $table = 'parents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_uri', 'date_of_birth', 'pin', 'is_primary'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Store attributes and their casts
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
        'is_primary' => 'bool'
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

    protected $appends = ['full_photo_uri'];

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
     * Relationship to this parent's children
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany(
            \App\Models\Child::class,
            'children_to_parents',
            'parent_id',
            'child_id'
        );
    }

    /**
     * Query scope for where belongs to daycare
     *
     * @param Builder $query
     * @param int $daycare_id
     */
    public function scopeWhereDaycareId(Builder $query, $daycare_id)
    {
        $query->select($this->getTable() . '.*')
            ->join('users', 'users.id', '=', $this->getTable() . '.user_id')
            ->where('users.daycare_id', '=', $daycare_id);
    }

    /**
     * Gets the full photo uri
     *
     * @return string
     */
    public function getFullPhotoUriAttribute()
    {
        if (empty($this->photo_uri)) {
            return asset('/img/portrait.png');
        }
        return asset('storage/' . $this->photo_uri);
    }
}
