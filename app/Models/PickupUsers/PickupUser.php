<?php

namespace App\Models\PickupUsers;

use Illuminate\Database\Eloquent\Model;

class PickupUser extends Model
{
    protected $table = 'pickup_users';

    protected $fillable = ['name', 'email', 'phone', 'pin', 'photo_uri'];

    protected $appends = ['full_photo_uri', 'full_photo_uri_original'];

    /**
     * Returns relationship to the child
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child()
    {
        return $this->belongsTo(\App\Models\Child::class, 'child_id');
    }

    /**
     * Returns relationship to the relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relation()
    {
        return $this->belongsTo(\App\Models\PickupUsers\Relation::class, 'relation_id');
    }

    /**
     * Get full photo uri
     *
     * @return string
     */
    public function getFullPhotoUriAttribute()
    {
        if ($this->photo_uri == "") {
            return  asset('/img/portrait.png');
        }

        return asset('storage/' . $this->photo_uri);
    }

    /**
     * Get full photo uri for the original photo
     *
     * @return string
     */
    public function getFullPhotoUriOriginalAttribute()
    {
        if ($this->photo_uri == "") {
            return  asset('/img/portrait.png');
        }

        $split_uri = explode('/', $this->photo_uri);
        $file_name = array_pop($split_uri);
        $full_uri = implode('/', $split_uri) . '/original/' . $file_name;
        return asset('storage/' . $full_uri);
    }
}
